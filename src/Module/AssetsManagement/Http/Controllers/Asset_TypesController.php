<?php
namespace Modules\AssetsManagement\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_TypesRepositoryInterface;
use Modules\AssetsManagement\Entities\Asset_Types;
use Illuminate\Validation\Rule; 

use DB;
use DataTables;

class Asset_TypesController extends Controller
{
    protected $asset_typesRepository;

    public function __construct(Asset_TypesRepositoryInterface $asset_typesRepository)
    {
        $this->asset_typesRepository = $asset_typesRepository;
    }
    
    public function index(Request $request)
    {   
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        $data['title'] = "Assets returns title"; 

        //if (!empty($keyword))
        //{

          //  $asset_types = Asset_Types::with([])->get();
           
        //}else{
          //      $asset_types = Asset_Types::with([])->paginate($perPage);
          //   }

		//$data['asset_types'] = $asset_types; 

        $data['asset_types'] = $this->asset_typesRepository->getAll($perPage, $keyword);

        return view('assetsmanagement::asset_types/list', $data);
    }
    
    public function create()
    {
       $data = array();

       	$data['title'] = "Assets returns add"; 

       return view('assetsmanagement::asset_types/add', $data);
   }

   public function store(Request $request)
   {

     $data = array();

     $request->validate([
                            'form_name' => 'required',

                        ]);

     $asset_types = new Asset_Types;
     $asset_types->name = $request->post('form_name');

     

     $data = [
            'name'        => $request->post('form_name'),
        ];

     //if($asset_types->save())
     if ($this->asset_typesRepository->create($data))
     {
        return redirect()->route('asset_types.listing')->with('success_message', 'Password has been saved successfully.');
     }else{
             return redirect()->route('asset_types.listing')->with('error_message', 'Error while saving record.');
             //App::abort(500, 'Error');
         }
   }

   public function show(Request $request,$id)
   {
     $data = array();

     $data['title'] = "Assets returns detail"; 
     //$data['asset_types']=Asset_Types::with([])->find($id);
     $data['asset_types'] = $this->asset_typesRepository->findById($id);

     return view('assetsmanagement::asset_types/show', $data);
  }

  public function edit($id)
  {
     $data = array();
	
     $data['title'] = "Assets returns edit"; 		

     //$data['asset_types']= Asset_Types::find($id);

     $data['asset_types'] = $this->asset_typesRepository->findById($id);

     return view('assetsmanagement::asset_types/edit', $data);

  }

  public function update(Request $request,$id)
  {

    $data = array();

    $request->validate(['form_name' => 'required',
]);

    $asset_types=Asset_Types::find($id);

    $asset_types->name = $request->post('form_name');


    $data = [
            'name'        => $request->post('form_name'),
        ];

    //if($asset_types->save())
    if ($this->asset_typesRepository->update($id, $data))
    {
       return redirect()->route('asset_types.listing')->with('success_message', 'Record has updated successfully.');
    }else{
           return redirect()->route('asset_types.listing')->with('error_message', 'Error while updating record.');
           //App::abort(500, 'Error');
         }
  }

  public function destroy($id)
  {

    //$asset_types=Asset_Types::find($id);
    
    //if($asset_types->delete())
    if ($this->asset_typesRepository->delete($id))
    {
       return redirect()->route('asset_types.listing')->with('success','User deleted successfully.');
    
    }else{
           return redirect()->route('asset_types.listing')->with('error_message', 'Error while deleting record.');
           //App::abort(500, 'Error');
         }
  }

#yajra
 public function yajra_index(Request $request)
    {
        
       $data = array();
        return view('assetsmanagement::asset_types/yajralisting', $data);
    }

    public function yajra_data(Request $request)
    {

        if ($request->ajax()) {
            
            
            $data = Asset_Types::with([]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){ $btn = $row->id; return $btn; })

                   ->addColumn('action', function($item){

$editlink = "<a href='".route('asset_types.editing', ['id' => $item->id])."' title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>";
$showlink = "<a href='".route('asset_types.showing', ['id' => $item->id])."' title='Show'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>";
$deleelink = "<a href='".route('asset_types.deleting', ['id' => $item->id])."' title='Delete'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>";


$btn = ''.$editlink.''.$showlink.''.$deleelink;
                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }

 }


    public function importing(Request $request)
    {   
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        $data['title'] = "Import data"; 

        if($request->importSubmit)
        {
            $result = importExcelToTable('account_types', $request->importfile);

            if ($result['success']) 
            {
                echo "Imported {$result['stats']['imported']} records";
            } else {
                echo "Error: {$result['message']}";
            }
        }

        

        return view('assetsmanagement::asset_types/importing', $data);
    }
    

}
