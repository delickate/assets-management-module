<?php
namespace Modules\AssetsManagement\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_ReturnsRepositoryInterface;
use Modules\AssetsManagement\Entities\Asset_Returns;
use Modules\AssetsManagement\Entities\Asset_Assignments;


use DB;
use DataTables;

class Asset_ReturnsController extends Controller
{
    protected $asset_returnsRepository;

    public function __construct(Asset_ReturnsRepositoryInterface $asset_returnsRepository)
    {
        $this->asset_returnsRepository = $asset_returnsRepository;
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        $data['title'] = "Assets returns list"; 

        //if (!empty($keyword))
        //{

          //  $asset_returns = Asset_Returns::with(['Asset_Assignments', ])->get();
           
        //}else{
          //      $asset_returns = Asset_Returns::with(['Asset_Assignments', ])->paginate($perPage);
          //   }

		//$data['asset_returns'] = $asset_returns; 

        $data['asset_returns'] = $this->asset_returnsRepository->getAll($perPage, $keyword);

        return view('assetsmanagement::asset_returns/list', $data);
    }
    
    public function create()
    {
       $data = array();

       $data['title'] = "Assets returns add"; 

       $data['asset_assignments'] = Asset_Assignments::orderBy('assigned_date')->pluck('assigned_date', 'id');
	

       return view('assetsmanagement::asset_returns/add', $data);
   }

   public function store(Request $request)
   {

     $data = array();

     $request->validate([
                            'form_return_date' => 'required',
'form_condition' => 'required',
'form_remarks' => 'required',
'form_asset_assignment_id' => 'required',

                        ]);

     $asset_returns = new Asset_Returns;
     $asset_returns->return_date = $request->post('form_return_date');
$asset_returns->condition = $request->post('form_condition');
$asset_returns->remarks = $request->post('form_remarks');
$asset_returns->asset_assignment_id = $request->post('form_asset_assignment_id');

     

     $data = [
            'return_date'        => $request->post('form_return_date'),'condition'        => $request->post('form_condition'),'remarks'        => $request->post('form_remarks'),'asset_assignment_id'        => $request->post('form_asset_assignment_id'),
        ];

     //if($asset_returns->save())
     if ($this->asset_returnsRepository->create($data))
     {
        return redirect()->route('asset_returns.listing')->with('success_message', 'Password has been saved successfully.');
     }else{
             return redirect()->route('asset_returns.listing')->with('error_message', 'Error while saving record.');
             //App::abort(500, 'Error');
         }
   }

   public function show(Request $request,$id)
   {
     $data = array();

     $data['title'] = "Assets returns detail"; 
     //$data['asset_returns']=Asset_Returns::with(['Asset_Assignments', ])->find($id);
     $data['asset_returns'] = $this->asset_returnsRepository->findById($id);

     return view('assetsmanagement::asset_returns/show', $data);
  }

  public function edit($id)
  {
     $data = array();

     $data['title'] = "Assets returns edit"; 
	
     $data['asset_assignments'] = Asset_Assignments::orderBy('assigned_date')->pluck('assigned_date', 'id');
		

     //$data['asset_returns']= Asset_Returns::find($id);

     $data['asset_returns'] = $this->asset_returnsRepository->findById($id);

     return view('assetsmanagement::asset_returns/edit', $data);

  }

  public function update(Request $request,$id)
  {

    $data = array();

    $request->validate(['form_return_date' => 'required',
'form_condition' => 'required',
'form_remarks' => 'required',
'form_asset_assignment_id' => 'required',
]);

    $asset_returns=Asset_Returns::find($id);

    $asset_returns->return_date = $request->post('form_return_date');
$asset_returns->condition = $request->post('form_condition');
$asset_returns->remarks = $request->post('form_remarks');
$asset_returns->asset_assignment_id = $request->post('form_asset_assignment_id');


    $data = [
            'return_date'        => $request->post('form_return_date'),'condition'        => $request->post('form_condition'),'remarks'        => $request->post('form_remarks'),'asset_assignment_id'        => $request->post('form_asset_assignment_id'),
        ];

    //if($asset_returns->save())
    if ($this->asset_returnsRepository->update($id, $data))
    {
       return redirect()->route('asset_returns.listing')->with('success_message', 'Record has updated successfully.');
    }else{
           return redirect()->route('asset_returns.listing')->with('error_message', 'Error while updating record.');
           //App::abort(500, 'Error');
         }
  }

  public function destroy($id)
  {

    //$asset_returns=Asset_Returns::find($id);
    
    //if($asset_returns->delete())
    if ($this->asset_returnsRepository->delete($id))
    {
       return redirect()->route('asset_returns.listing')->with('success','User deleted successfully.');
    
    }else{
           return redirect()->route('asset_returns.listing')->with('error_message', 'Error while deleting record.');
           //App::abort(500, 'Error');
         }
  }

#yajra
 public function yajra_index(Request $request)
    {
        
       $data = array();
        return view('assetsmanagement::asset_returns/yajralisting', $data);
    }

    public function yajra_data(Request $request)
    {

        if ($request->ajax()) {
            
            
            $data = Asset_Returns::with(['Asset_Assignments', ]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){ $btn = $row->id; return $btn; })
->addColumn('', function($row){ $btn = ''; if(isset($row->asset_assignments)) { $btn = $row->asset_assignments->asset_assignment_id; return $btn; } })

                   ->addColumn('action', function($item){

$editlink = "<a href='".route('asset_returns.editing', ['id' => $item->id])."' title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>";
$showlink = "<a href='".route('asset_returns.showing', ['id' => $item->id])."' title='Show'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>";
$deleelink = "<a href='".route('asset_returns.deleting', ['id' => $item->id])."' title='Delete'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>";


$btn = ''.$editlink.''.$showlink.''.$deleelink;
                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }

 }
}
