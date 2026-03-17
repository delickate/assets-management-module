<?php
namespace Modules\AssetsManagement\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_AssignmentsRepositoryInterface;
use Modules\AssetsManagement\Entities\Asset_Assignments;
use Modules\AssetsManagement\Entities\Assets;
use Modules\AssetsManagement\Entities\Asset_Types;


use DB;
use DataTables;

class Asset_AssignmentsController extends Controller
{
    protected $asset_assignmentsRepository;

    public function __construct(Asset_AssignmentsRepositoryInterface $asset_assignmentsRepository)
    {
        $this->asset_assignmentsRepository = $asset_assignmentsRepository;
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        $data['title'] = "Assets assignment list"; 

        //if (!empty($keyword))
        //{

          //  $asset_assignments = Asset_Assignments::with(['Assets', 'Asset_Types', ])->get();
           
        //}else{
          //      $asset_assignments = Asset_Assignments::with(['Assets', 'Asset_Types', ])->paginate($perPage);
          //   }

		//$data['asset_assignments'] = $asset_assignments; 

        $data['asset_assignments'] = $this->asset_assignmentsRepository->getAll($perPage, $keyword);

        return view('assetsmanagement::asset_assignments/list', $data);
    }
    
    public function create()
    {
       $data = array();

       $data['title'] = "Assets assignment add"; 

       $data['assets'] = Assets::orderBy('asset_name')->pluck('asset_name', 'id');
$data['asset_types'] = Asset_Types::orderBy('name')->pluck('name', 'id');
	

       return view('assetsmanagement::asset_assignments/add', $data);
   }

   public function store(Request $request)
   {

     $data = array();

     $request->validate([
                            'form_assigned_date' => 'required',
'form_expected_return_date' => 'required',
'form_returned_date' => 'required',
'form_remarks' => 'required',
'form_asset_id' => 'required',
'form_asset_type_id' => 'required',

                        ]);

     $asset_assignments = new Asset_Assignments;
     $asset_assignments->assigned_date = $request->post('form_assigned_date');
$asset_assignments->expected_return_date = $request->post('form_expected_return_date');
$asset_assignments->returned_date = $request->post('form_returned_date');
$asset_assignments->remarks = $request->post('form_remarks');
$asset_assignments->asset_id = $request->post('form_asset_id');
$asset_assignments->asset_type_id = $request->post('form_asset_type_id');

     

     $data = [
            'assigned_date'        => $request->post('form_assigned_date'),'expected_return_date'        => $request->post('form_expected_return_date'),'returned_date'        => $request->post('form_returned_date'),'remarks'        => $request->post('form_remarks'),'asset_id'        => $request->post('form_asset_id'),'asset_type_id'        => $request->post('form_asset_type_id'),
        ];

     //if($asset_assignments->save())
     if ($this->asset_assignmentsRepository->create($data))
     {
        return redirect()->route('asset_assignments.listing')->with('success_message', 'Password has been saved successfully.');
     }else{
             return redirect()->route('asset_assignments.listing')->with('error_message', 'Error while saving record.');
             //App::abort(500, 'Error');
         }
   }

   public function show(Request $request,$id)
   {
     $data = array();

     $data['title'] = "Assets assignment show"; 
     //$data['asset_assignments']=Asset_Assignments::with(['Assets', 'Asset_Types', ])->find($id);
     $data['asset_assignments'] = $this->asset_assignmentsRepository->findById($id);

     return view('assetsmanagement::asset_assignments/show', $data);
  }

  public function edit($id)
  {
     $data = array();

     $data['title'] = "Assets assignment edit"; 
	
     $data['assets'] = Assets::orderBy('asset_name')->pluck('asset_name', 'id');
$data['asset_types'] = Asset_Types::orderBy('name')->pluck('name', 'id');
		

     //$data['asset_assignments']= Asset_Assignments::find($id);

     $data['asset_assignments'] = $this->asset_assignmentsRepository->findById($id);

     return view('assetsmanagement::asset_assignments/edit', $data);

  }

  public function update(Request $request,$id)
  {

    $data = array();

    $request->validate(['form_assigned_date' => 'required',
'form_expected_return_date' => 'required',
'form_returned_date' => 'required',
'form_remarks' => 'required',
'form_asset_id' => 'required',
'form_asset_type_id' => 'required',
]);

    $asset_assignments=Asset_Assignments::find($id);

    $asset_assignments->assigned_date = $request->post('form_assigned_date');
$asset_assignments->expected_return_date = $request->post('form_expected_return_date');
$asset_assignments->returned_date = $request->post('form_returned_date');
$asset_assignments->remarks = $request->post('form_remarks');
$asset_assignments->asset_id = $request->post('form_asset_id');
$asset_assignments->asset_type_id = $request->post('form_asset_type_id');


    $data = [
            'assigned_date'        => $request->post('form_assigned_date'),'expected_return_date'        => $request->post('form_expected_return_date'),'returned_date'        => $request->post('form_returned_date'),'remarks'        => $request->post('form_remarks'),'asset_id'        => $request->post('form_asset_id'),'asset_type_id'        => $request->post('form_asset_type_id'),
        ];

    //if($asset_assignments->save())
    if ($this->asset_assignmentsRepository->update($id, $data))
    {
       return redirect()->route('asset_assignments.listing')->with('success_message', 'Record has updated successfully.');
    }else{
           return redirect()->route('asset_assignments.listing')->with('error_message', 'Error while updating record.');
           //App::abort(500, 'Error');
         }
  }

  public function destroy($id)
  {

    //$asset_assignments=Asset_Assignments::find($id);
    
    //if($asset_assignments->delete())
    if ($this->asset_assignmentsRepository->delete($id))
    {
       return redirect()->route('asset_assignments.listing')->with('success','User deleted successfully.');
    
    }else{
           return redirect()->route('asset_assignments.listing')->with('error_message', 'Error while deleting record.');
           //App::abort(500, 'Error');
         }
  }

#yajra
 public function yajra_index(Request $request)
    {
        
       $data = array();
        return view('assetsmanagement::asset_assignments/yajralisting', $data);
    }

    public function yajra_data(Request $request)
    {

        if ($request->ajax()) {
            
            
            $data = Asset_Assignments::with(['Assets', 'Asset_Types', ]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){ $btn = $row->id; return $btn; })
->addColumn('', function($row){ $btn = ''; if(isset($row->assets)) { $btn = $row->assets->asset_id; return $btn; } })
->addColumn('', function($row){ $btn = ''; if(isset($row->asset_types)) { $btn = $row->asset_types->asset_type_id; return $btn; } })

                   ->addColumn('action', function($item){

$editlink = "<a href='".route('asset_assignments.editing', ['id' => $item->id])."' title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>";
$showlink = "<a href='".route('asset_assignments.showing', ['id' => $item->id])."' title='Show'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>";
$deleelink = "<a href='".route('asset_assignments.deleting', ['id' => $item->id])."' title='Delete'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>";


$btn = ''.$editlink.''.$showlink.''.$deleelink;
                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }

 }
}
