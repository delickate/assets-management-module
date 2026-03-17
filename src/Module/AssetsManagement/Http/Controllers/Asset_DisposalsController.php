<?php
namespace Modules\AssetsManagement\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_DisposalsRepositoryInterface;
use Modules\AssetsManagement\Entities\Asset_Disposals;
use Modules\AssetsManagement\Entities\Assets;


use DB;
use DataTables;

class Asset_DisposalsController extends Controller
{
    protected $asset_disposalsRepository;

    public function __construct(Asset_DisposalsRepositoryInterface $asset_disposalsRepository)
    {
        $this->asset_disposalsRepository = $asset_disposalsRepository;
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        $data['title'] = "Assets disposals list"; 

        //if (!empty($keyword))
        //{

          //  $asset_disposals = Asset_Disposals::with(['Assets', ])->get();
           
        //}else{
          //      $asset_disposals = Asset_Disposals::with(['Assets', ])->paginate($perPage);
          //   }

		//$data['asset_disposals'] = $asset_disposals; 

        $data['asset_disposals'] = $this->asset_disposalsRepository->getAll($perPage, $keyword);

        return view('assetsmanagement::asset_disposals/list', $data);
    }
    
    public function create()
    {
       $data = array();

       $data['title'] = "Assets disposals add"; 

       $data['assets'] = Assets::orderBy('asset_name')->pluck('asset_name', 'id');
	

       return view('assetsmanagement::asset_disposals/add', $data);
   }

   public function store(Request $request)
   {

     $data = array();

     $request->validate([
                            'form_disposal_date' => 'required',
'form_reason' => 'required',
'form_scrap_value' => 'required',
'form_remarks' => 'required',
'form_asset_id' => 'required',

                        ]);

     $asset_disposals = new Asset_Disposals;
     $asset_disposals->disposal_date = $request->post('form_disposal_date');
$asset_disposals->reason = $request->post('form_reason');
$asset_disposals->scrap_value = $request->post('form_scrap_value');
$asset_disposals->remarks = $request->post('form_remarks');
$asset_disposals->asset_id = $request->post('form_asset_id');

     

     $data = [
            'disposal_date'        => $request->post('form_disposal_date'),'reason'        => $request->post('form_reason'),'scrap_value'        => $request->post('form_scrap_value'),'remarks'        => $request->post('form_remarks'),'asset_id'        => $request->post('form_asset_id'),
        ];

     //if($asset_disposals->save())
     if ($this->asset_disposalsRepository->create($data))
     {
        return redirect()->route('asset_disposals.listing')->with('success_message', 'Password has been saved successfully.');
     }else{
             return redirect()->route('asset_disposals.listing')->with('error_message', 'Error while saving record.');
             //App::abort(500, 'Error');
         }
   }

   public function show(Request $request,$id)
   {
     $data = array();
     $data['title'] = "Assets disposals show"; 
     //$data['asset_disposals']=Asset_Disposals::with(['Assets', ])->find($id);
     $data['asset_disposals'] = $this->asset_disposalsRepository->findById($id);

     return view('assetsmanagement::asset_disposals/show', $data);
  }

  public function edit($id)
  {
     $data = array();

     $data['title'] = "Assets disposals edit"; 
	
     $data['assets'] = Assets::orderBy('asset_name')->pluck('asset_name', 'id');
		

     //$data['asset_disposals']= Asset_Disposals::find($id);

     $data['asset_disposals'] = $this->asset_disposalsRepository->findById($id);

     return view('assetsmanagement::asset_disposals/edit', $data);

  }

  public function update(Request $request,$id)
  {

    $data = array();

    $request->validate(['form_disposal_date' => 'required',
'form_reason' => 'required',
'form_scrap_value' => 'required',
'form_remarks' => 'required',
'form_asset_id' => 'required',
]);

    $asset_disposals=Asset_Disposals::find($id);

    $asset_disposals->disposal_date = $request->post('form_disposal_date');
$asset_disposals->reason = $request->post('form_reason');
$asset_disposals->scrap_value = $request->post('form_scrap_value');
$asset_disposals->remarks = $request->post('form_remarks');
$asset_disposals->asset_id = $request->post('form_asset_id');


    $data = [
            'disposal_date'        => $request->post('form_disposal_date'),'reason'        => $request->post('form_reason'),'scrap_value'        => $request->post('form_scrap_value'),'remarks'        => $request->post('form_remarks'),'asset_id'        => $request->post('form_asset_id'),
        ];

    //if($asset_disposals->save())
    if ($this->asset_disposalsRepository->update($id, $data))
    {
       return redirect()->route('asset_disposals.listing')->with('success_message', 'Record has updated successfully.');
    }else{
           return redirect()->route('asset_disposals.listing')->with('error_message', 'Error while updating record.');
           //App::abort(500, 'Error');
         }
  }

  public function destroy($id)
  {

    //$asset_disposals=Asset_Disposals::find($id);
    
    //if($asset_disposals->delete())
    if ($this->asset_disposalsRepository->delete($id))
    {
       return redirect()->route('asset_disposals.listing')->with('success','User deleted successfully.');
    
    }else{
           return redirect()->route('asset_disposals.listing')->with('error_message', 'Error while deleting record.');
           //App::abort(500, 'Error');
         }
  }

#yajra
 public function yajra_index(Request $request)
    {
        
       $data = array();
        return view('assetsmanagement::asset_disposals/yajralisting', $data);
    }

    public function yajra_data(Request $request)
    {

        if ($request->ajax()) {
            
            
            $data = Asset_Disposals::with(['Assets', ]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){ $btn = $row->id; return $btn; })
->addColumn('', function($row){ $btn = ''; if(isset($row->assets)) { $btn = $row->assets->asset_id; return $btn; } })

                   ->addColumn('action', function($item){

$editlink = "<a href='".route('asset_disposals.editing', ['id' => $item->id])."' title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>";
$showlink = "<a href='".route('asset_disposals.showing', ['id' => $item->id])."' title='Show'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>";
$deleelink = "<a href='".route('asset_disposals.deleting', ['id' => $item->id])."' title='Delete'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>";


$btn = ''.$editlink.''.$showlink.''.$deleelink;
                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }

 }
}
