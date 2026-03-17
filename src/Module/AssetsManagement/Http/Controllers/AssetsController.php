<?php
namespace Modules\AssetsManagement\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Modules\AssetsManagement\Repositories\Interfaces\AssetsRepositoryInterface;
use Modules\AssetsManagement\Entities\Assets;
use Modules\AssetsManagement\Entities\Vendors;
use Modules\AssetsManagement\Entities\Locations;
use Modules\AssetsManagement\Entities\Asset_Types;


use DB;
use DataTables;

class AssetsController extends Controller
{
    protected $assetsRepository;

    public function __construct(AssetsRepositoryInterface $assetsRepository)
    {
        $this->assetsRepository = $assetsRepository;
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        $data['title'] = "Assets title"; 

        //if (!empty($keyword))
        //{

          //  $assets = Assets::with(['Vendors', 'Locations', 'Asset_Types', ])->get();
           
        //}else{
          //      $assets = Assets::with(['Vendors', 'Locations', 'Asset_Types', ])->paginate($perPage);
          //   }

		//$data['assets'] = $assets; 

        $data['assets'] = $this->assetsRepository->getAll($perPage, $keyword);

        return view('assetsmanagement::assets/list', $data);
    }
    
    public function create()
    {
       $data = array();

       $data['title'] = "Assets add"; 

       $data['vendors'] = Vendors::orderBy('name')->pluck('name', 'id');
$data['locations'] = Locations::orderBy('name')->pluck('name', 'id');
$data['asset_types'] = Asset_Types::orderBy('name')->pluck('name', 'id');
	

       return view('assetsmanagement::assets/add', $data);
   }

   public function store(Request $request)
   {

     $data = array();

        $request->validate([
            'form_asset_tag'            => 'required',
            'form_asset_name'           => 'required',
            'form_brand'                => 'required',
            'form_model'                => 'required',
            'form_serial_number'        => 'required',
            'form_purchase_date'        => 'required',
            'form_purchase_cost'        => 'required',
            'form_warranty_expiry_date' => 'required',
            'form_remarks'              => 'required',
            'form_vendor_id'           => 'required',
            'form_location_id'         => 'required',
            'form_asset_type_id'       => 'required',
        ]);

        $data = [
            'asset_tag'             => $request->post('form_asset_tag'),
            'asset_name'            => $request->post('form_asset_name'),
            'brand'                 => $request->post('form_brand'),
            'model'                 => $request->post('form_model'),
            'serial_number'         => $request->post('form_serial_number'),
            'purchase_date'         => $request->post('form_purchase_date'),
            'purchase_cost'         => $request->post('form_purchase_cost'),
            'warranty_expiry_date'  => $request->post('form_warranty_expiry_date'),
            'remarks'               => $request->post('form_remarks'),
            'vendor_id'             => $request->post('form_vendor_id'),
            'location_id'           => $request->post('form_location_id'),
            'asset_type_id'         => $request->post('form_asset_type_id'),
        ];

        try {
                DB::beginTransaction();
                
                // Save the asset
                $asset = $this->assetsRepository->create($data);
                
                if (!$asset) 
                {
                    return redirect()->route('assets.listing')->with('error_message', 'Error while saving asset record.');
                }
                
                // Get the accounting integration rules for asset purchase
                $integrationRules = DB::table('asset_accounts_integration')
                                    ->where('module_name', 'asset_purchase')
                                    ->where('is_active', 1)
                                    ->where(function($query) use ($request) 
                                    {
                                        $query->where('asset_type_id', $request->post('form_asset_type_id'))
                                              ->orWhereNull('asset_type_id');
                                    })
                                    ->orderBy('asset_type_id', 'desc') // Prefer asset-type specific rules over generic ones
                                    ->first();
                
                if (!$integrationRules) 
                {
                    return redirect()->route('assets.listing')->with('error_message', 'No accounting integration rules found for asset purchase.');
                }
                
                // Create voucher for the asset purchase
                $voucherData = [
                                    'voucher_date'  => $request->post('form_purchase_date',true),
                                    'reference'     => 'Asset Purchase - ' . $request->post('form_asset_tag',true),
                                    'description'   => 'Purchase of asset: ' . $request->post('form_asset_name',true),
                                    'amount'        => $request->post('form_purchase_cost'),
                                    'status'        => 'posted',
                                    'created_by'    => auth()->id(),
                                ];
                
                $voucher = DB::table('vouchers')->insertGetId($voucherData);
                
                if (!$voucher) 
                {
                    return redirect()->route('assets.listing')->with('error_message', 'Error while creating voucher.');
                }
                
                // Create voucher entries (debit and credit)
                $debitEntry = [
                                'voucher_id'    => $voucher,
                                'account_id'    => $integrationRules->debit_account_id,
                                'amount'        => $request->post('form_purchase_cost'),
                                'type'          => 'debit',
                                'description'   => 'Asset Purchase - ' . $request->post('form_asset_name'),
                            ];
                
                $creditEntry = [
                                    'voucher_id'    => $voucher,
                                    'account_id'    => $integrationRules->credit_account_id,
                                    'amount'        => $request->post('form_purchase_cost'),
                                    'type'          => 'credit',
                                    'description'   => 'Asset Purchase - ' . $request->post('form_asset_name'),
                                ];
                
                DB::table('voucher_entries')->insert($debitEntry);
                DB::table('voucher_entries')->insert($creditEntry);
                
                // Link the voucher to the asset for future reference
                DB::table('asset_vouchers')->insert([
                                                        'asset_id'          => $asset->id,
                                                        'voucher_id'        => $voucher,
                                                        'transaction_type' => 'purchase',
                                                        'created_at' => now(),
                                                        'updated_at' => now(),
                                                    ]);
                
                DB::commit();
            
            return redirect()->route('assets.listing')->with('success_message', 'Asset has been saved successfully with accounting entries.');
            
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('assets.listing')->with('error_message', $e->getMessage());
        }
   }

   public function show(Request $request,$id)
   {
     $data = array();

     $data['title'] = "Assets detail"; 
     //$data['assets']=Assets::with(['Vendors', 'Locations', 'Asset_Types', ])->find($id);
     $data['assets'] = $this->assetsRepository->findById($id);

     return view('assetsmanagement::assets/show', $data);
  }

  public function edit($id)
  {
     $data = array();

     $data['title'] = "Assets edit"; 
	
     $data['vendors'] = Vendors::orderBy('name')->pluck('name', 'id');
$data['locations'] = Locations::orderBy('name')->pluck('name', 'id');
$data['asset_types'] = Asset_Types::orderBy('name')->pluck('name', 'id');
		

     //$data['assets']= Assets::find($id);

     $data['assets'] = $this->assetsRepository->findById($id);

     return view('assetsmanagement::assets/edit', $data);

  }

  public function update(Request $request, $id)
    {
        $request->validate([
            'form_asset_tag'        => 'required',
            'form_asset_name'       => 'required',
            'form_brand'            => 'required',
            'form_model'            => 'required',
            'form_serial_number'    => 'required',
            'form_purchase_date'    => 'required',
            'form_purchase_cost'    => 'required|numeric|min:0',
            'form_warranty_expiry_date' => 'required',
            'form_remarks'              => 'required',
            'form_vendor_id'            => 'required',
            'form_location_id'          => 'required',
            'form_asset_type_id'        => 'required',
        ]);

        try {
                DB::beginTransaction();

                // Get the existing asset
                $asset          = Assets::findOrFail($id);
                $originalCost   = $asset->purchase_cost;
                $newCost        = $request->post('form_purchase_cost');
                $costDifference = $newCost - $originalCost;

                // Prepare update data
                $data = [
                            'asset_tag'             => $request->post('form_asset_tag',true),
                            'asset_name'            => $request->post('form_asset_name',true),
                            'brand'                 => $request->post('form_brand',true),
                            'model'                 => $request->post('form_model',true),
                            'serial_number'         => $request->post('form_serial_number',true),
                            'purchase_date'         => $request->post('form_purchase_date',true),
                            'purchase_cost'         => $newCost,
                            'warranty_expiry_date'  => $request->post('form_warranty_expiry_date',true),
                            'remarks'               => $request->post('form_remarks',true),
                            'vendor_id'             => $request->post('form_vendor_id',true),
                            'location_id'           => $request->post('form_location_id',true),
                            'asset_type_id'         => $request->post('form_asset_type_id',true),
                        ];

                // Update the asset
                if (!$this->assetsRepository->update($id, $data)) 
                {
                     return redirect()->route('assets.listing')->with('Error while updating asset record.');
                }

                // Handle voucher creation if cost changed
                if ($costDifference != 0) 
                {
                    // Get accounting integration rules
                    $integrationRules = DB::table('asset_accounts_integration')
                        ->where('module_name', 'asset_update')
                        ->where('is_active', 1)
                        ->where(function($query) use ($request) {
                            $query->where('asset_type_id', $request->post('form_asset_type_id'))
                                  ->orWhereNull('asset_type_id');
                        })
                        ->orderBy('asset_type_id', 'desc')
                        ->first();

                    if (!$integrationRules) 
                    {
                        return redirect()->route('assets.listing')->with('No accounting integration rules found for asset updates.');
                    }

                    // Determine voucher type based on cost change
                    $voucherType = ($costDifference > 0) ? 'asset_value_increase' : 'asset_value_decrease';
                    $absoluteDifference = abs($costDifference);

                    // Create voucher
                    $voucherData = [
                                        'voucher_date'      => now(),
                                        'reference'         => 'Asset Update - ' . $request->post('form_asset_tag'),
                                        'description'       => ($costDifference > 0) 
                                            ? 'Increase in asset value: ' . $request->post('form_asset_name') 
                                            : 'Decrease in asset value: ' . $request->post('form_asset_name'),
                                        'amount'            => $absoluteDifference,
                                        'status'            => 'posted',
                                        'created_by'        => auth()->id(),
                                    ];

                    $voucher = DB::table('vouchers')->insertGetId($voucherData);

                    if (!$voucher) 
                    {
                        return redirect()->route('assets.listing')->with('Error while creating voucher.');
                    }

                    // Create voucher entries
                    if ($costDifference > 0) 
                    {
                        // Cost increased: Debit Asset, Credit Cash/Bank
                        $debitEntry = [
                                            'voucher_id'    => $voucher,
                                            'account_id'    => $integrationRules->debit_account_id,
                                            'amount'        => $absoluteDifference,
                                            'type'          => 'debit',
                                            'description'   => 'Asset Value Increase - ' . $request->post('form_asset_name'),
                                        ];

                        $creditEntry = [
                                            'voucher_id'    => $voucher,
                                            'account_id'    => $integrationRules->credit_account_id,
                                            'amount'        => $absoluteDifference,
                                            'type'          => 'credit',
                                            'description'   => 'Asset Value Increase - ' . $request->post('form_asset_name'),
                                        ];
                    } else {
                        // Cost decreased: Debit Cash/Bank, Credit Asset
                        $debitEntry = [
                            'voucher_id'    => $voucher,
                            'account_id'    => $integrationRules->credit_account_id, // Reversed
                            'amount'        => $absoluteDifference,
                            'type'          => 'debit',
                            'description'   => 'Asset Value Decrease - ' . $request->post('form_asset_name'),
                        ];

                        $creditEntry = [
                            'voucher_id'    => $voucher,
                            'account_id'    => $integrationRules->debit_account_id, // Reversed
                            'amount'        => $absoluteDifference,
                            'type'          => 'credit',
                            'description'   => 'Asset Value Decrease - ' . $request->post('form_asset_name'),
                        ];
                    }

                    DB::table('voucher_entries')->insert($debitEntry);
                    DB::table('voucher_entries')->insert($creditEntry);

                    // Link the voucher to the asset
                    DB::table('asset_vouchers')->insert([
                        'asset_id'          => $id,
                        'voucher_id'        => $voucher,
                        'transaction_type'  => $voucherType,
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]);
                }

                DB::commit();
            return redirect()->route('assets.listing')->with('success_message', 'Record has been updated successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('assets.listing')->with('error_message', $e->getMessage());
        }
    }

  public function destroy($id)
  {

    //$assets=Assets::find($id);
    
    //if($assets->delete())
    if ($this->assetsRepository->delete($id))
    {
       return redirect()->route('assets.listing')->with('success','User deleted successfully.');
    
    }else{
           return redirect()->route('assets.listing')->with('error_message', 'Error while deleting record.');
           //App::abort(500, 'Error');
         }
  }

#yajra
 public function yajra_index(Request $request)
    {
        
       $data = array();
        return view('assetsmanagement::assets/yajralisting', $data);
    }

    public function yajra_data(Request $request)
    {

        if ($request->ajax()) {
            
            
            $data = Assets::with(['Vendors', 'Locations', 'Asset_Types', ]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){ $btn = $row->id; return $btn; })
->addColumn('', function($row){ $btn = ''; if(isset($row->vendors)) { $btn = $row->vendors->vendor_id; return $btn; } })
->addColumn('', function($row){ $btn = ''; if(isset($row->locations)) { $btn = $row->locations->location_id; return $btn; } })
->addColumn('', function($row){ $btn = ''; if(isset($row->asset_types)) { $btn = $row->asset_types->asset_type_id; return $btn; } })

                   ->addColumn('action', function($item){

$editlink = "<a href='".route('assets.editing', ['id' => $item->id])."' title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>";
$showlink = "<a href='".route('assets.showing', ['id' => $item->id])."' title='Show'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>";
$deleelink = "<a href='".route('assets.deleting', ['id' => $item->id])."' title='Delete'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>";


$btn = ''.$editlink.''.$showlink.''.$deleelink;
                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }

 }
}
