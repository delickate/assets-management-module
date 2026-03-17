<?php
namespace Modules\AssetsManagement\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_MaintenanceRepositoryInterface;
use Modules\AssetsManagement\Entities\Asset_Maintenance;
use Modules\AssetsManagement\Entities\Assets;


use DB;
use DataTables;

class Asset_MaintenanceController extends Controller
{
    protected $asset_maintenanceRepository;

    public function __construct(Asset_MaintenanceRepositoryInterface $asset_maintenanceRepository)
    {
        $this->asset_maintenanceRepository = $asset_maintenanceRepository;
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        $data['title'] = "Assets maintenance list"; 

        //if (!empty($keyword))
        //{

          //  $asset_maintenance = Asset_Maintenance::with(['Assets', ])->get();
           
        //}else{
          //      $asset_maintenance = Asset_Maintenance::with(['Assets', ])->paginate($perPage);
          //   }

		//$data['asset_maintenance'] = $asset_maintenance; 

        $data['asset_maintenance'] = $this->asset_maintenanceRepository->getAll($perPage, $keyword);

        return view('assetsmanagement::asset_maintenance/list', $data);
    }
    
    public function create()
    {
       $data = array();

       $data['title'] = "Assets maintenance add"; 

       $data['assets'] = Assets::orderBy('asset_name')->pluck('asset_name', 'id');
	

       return view('assetsmanagement::asset_maintenance/add', $data);
   }

   public function store(Request $request)
   {

     $data = array();

     $request->validate([
                            'form_maintenance_date' => 'required',
'form_type' => 'required',
'form_cost' => 'required',
'form_remarks' => 'required',
'form_asset_id' => 'required',

                        ]);

     $asset_maintenance = new Asset_Maintenance;
     $asset_maintenance->maintenance_date = $request->post('form_maintenance_date');
$asset_maintenance->type = $request->post('form_type');
$asset_maintenance->cost = $request->post('form_cost');
$asset_maintenance->remarks = $request->post('form_remarks');
$asset_maintenance->asset_id = $request->post('form_asset_id');

     

     $data = [
            'maintenance_date'        => $request->post('form_maintenance_date'),'type'        => $request->post('form_type'),'cost'        => $request->post('form_cost'),'remarks'        => $request->post('form_remarks'),'asset_id'        => $request->post('form_asset_id'),
        ];

     //if($asset_maintenance->save())
     if ($this->asset_maintenanceRepository->create($data))
     {
        return redirect()->route('asset_maintenance.listing')->with('success_message', 'Password has been saved successfully.');
     }else{
             return redirect()->route('asset_maintenance.listing')->with('error_message', 'Error while saving record.');
             //App::abort(500, 'Error');
         }
   }

   public function show(Request $request,$id)
   {
     $data = array();

     $data['title'] = "Assets maintenance detail"; 
     //$data['asset_maintenance']=Asset_Maintenance::with(['Assets', ])->find($id);
     $data['asset_maintenance'] = $this->asset_maintenanceRepository->findById($id);

     return view('assetsmanagement::asset_maintenance/show', $data);
  }

  public function edit($id)
  {
     $data = array();

     $data['title'] = "Assets maintenance edit"; 
	
     $data['assets'] = Assets::orderBy('asset_name')->pluck('asset_name', 'id');
		

     //$data['asset_maintenance']= Asset_Maintenance::find($id);

     $data['asset_maintenance'] = $this->asset_maintenanceRepository->findById($id);

     return view('assetsmanagement::asset_maintenance/edit', $data);

  }

  public function update(Request $request,$id)
  {

    $data = array();

    $request->validate(['form_maintenance_date' => 'required',
'form_type' => 'required',
'form_cost' => 'required',
'form_remarks' => 'required',
'form_asset_id' => 'required',
]);

    $asset_maintenance=Asset_Maintenance::find($id);

    $asset_maintenance->maintenance_date = $request->post('form_maintenance_date');
$asset_maintenance->type = $request->post('form_type');
$asset_maintenance->cost = $request->post('form_cost');
$asset_maintenance->remarks = $request->post('form_remarks');
$asset_maintenance->asset_id = $request->post('form_asset_id');


    $data = [
            'maintenance_date'        => $request->post('form_maintenance_date'),'type'        => $request->post('form_type'),'cost'        => $request->post('form_cost'),'remarks'        => $request->post('form_remarks'),'asset_id'        => $request->post('form_asset_id'),
        ];

    //if($asset_maintenance->save())
    if ($this->asset_maintenanceRepository->update($id, $data))
    {
       return redirect()->route('asset_maintenance.listing')->with('success_message', 'Record has updated successfully.');
    }else{
           return redirect()->route('asset_maintenance.listing')->with('error_message', 'Error while updating record.');
           //App::abort(500, 'Error');
         }
  }

  public function destroy($id)
  {

    //$asset_maintenance=Asset_Maintenance::find($id);
    
    //if($asset_maintenance->delete())
    if ($this->asset_maintenanceRepository->delete($id))
    {
       return redirect()->route('asset_maintenance.listing')->with('success','User deleted successfully.');
    
    }else{
           return redirect()->route('asset_maintenance.listing')->with('error_message', 'Error while deleting record.');
           //App::abort(500, 'Error');
         }
  }

#yajra
 public function yajra_index(Request $request)
    {
        
       $data = array();
        return view('assetsmanagement::asset_maintenance/yajralisting', $data);
    }

    public function yajra_data(Request $request)
    {

        if ($request->ajax()) {
            
            
            $data = Asset_Maintenance::with(['Assets', ]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){ $btn = $row->id; return $btn; })
->addColumn('', function($row){ $btn = ''; if(isset($row->assets)) { $btn = $row->assets->asset_id; return $btn; } })

                   ->addColumn('action', function($item){

$editlink = "<a href='".route('asset_maintenance.editing', ['id' => $item->id])."' title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>";
$showlink = "<a href='".route('asset_maintenance.showing', ['id' => $item->id])."' title='Show'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>";
$deleelink = "<a href='".route('asset_maintenance.deleting', ['id' => $item->id])."' title='Delete'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>";


$btn = ''.$editlink.''.$showlink.''.$deleelink;
                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }

 }
}
