<?php
namespace Modules\AssetsManagement\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Modules\AssetsManagement\Repositories\Interfaces\LocationsRepositoryInterface;
use Modules\AssetsManagement\Entities\Locations;


use DB;
use DataTables;

class LocationsController extends Controller
{
    protected $locationsRepository;

    public function __construct(LocationsRepositoryInterface $locationsRepository)
    {
        $this->locationsRepository = $locationsRepository;
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        $data['title'] = "Locations list"; 

        //if (!empty($keyword))
        //{

          //  $locations = Locations::with([])->get();
           
        //}else{
          //      $locations = Locations::with([])->paginate($perPage);
          //   }

		//$data['locations'] = $locations; 

        $data['locations'] = $this->locationsRepository->getAll($perPage, $keyword);

        return view('assetsmanagement::locations/list', $data);
    }
    
    public function create()
    {
       $data = array();

       $data['title'] = "Locations add"; 	

       return view('assetsmanagement::locations/add', $data);
   }

   public function store(Request $request)
   {

     $data = array();

     $request->validate([
                            'form_name' => 'required',
'form_description' => 'required',

                        ]);

     $locations = new Locations;
     $locations->name = $request->post('form_name');
$locations->description = $request->post('form_description');

     

     $data = [
            'name'        => $request->post('form_name'),'description'        => $request->post('form_description'),
        ];

     //if($locations->save())
     if ($this->locationsRepository->create($data))
     {
        return redirect()->route('locations.listing')->with('success_message', 'Password has been saved successfully.');
     }else{
             return redirect()->route('locations.listing')->with('error_message', 'Error while saving record.');
             //App::abort(500, 'Error');
         }
   }

   public function show(Request $request,$id)
   {
     $data = array();
     $data['title'] = "Locations show"; 
     //$data['locations']=Locations::with([])->find($id);
     $data['locations'] = $this->locationsRepository->findById($id);

     return view('assetsmanagement::locations/show', $data);
  }

  public function edit($id)
  {
     $data = array();
	
     		
     $data['title'] = "Locations edit"; 
     //$data['locations']= Locations::find($id);

     $data['locations'] = $this->locationsRepository->findById($id);

     return view('assetsmanagement::locations/edit', $data);

  }

  public function update(Request $request,$id)
  {

    $data = array();

    $request->validate(['form_name' => 'required',
'form_description' => 'required',
]);

    $locations=Locations::find($id);

    $locations->name = $request->post('form_name');
$locations->description = $request->post('form_description');


    $data = [
            'name'        => $request->post('form_name'),'description'        => $request->post('form_description'),
        ];

    //if($locations->save())
    if ($this->locationsRepository->update($id, $data))
    {
       return redirect()->route('locations.listing')->with('success_message', 'Record has updated successfully.');
    }else{
           return redirect()->route('locations.listing')->with('error_message', 'Error while updating record.');
           //App::abort(500, 'Error');
         }
  }

  public function destroy($id)
  {

    //$locations=Locations::find($id);
    
    //if($locations->delete())
    if ($this->locationsRepository->delete($id))
    {
       return redirect()->route('locations.listing')->with('success','User deleted successfully.');
    
    }else{
           return redirect()->route('locations.listing')->with('error_message', 'Error while deleting record.');
           //App::abort(500, 'Error');
         }
  }

#yajra
 public function yajra_index(Request $request)
    {
        
       $data = array();
        return view('assetsmanagement::locations/yajralisting', $data);
    }

    public function yajra_data(Request $request)
    {

        if ($request->ajax()) {
            
            
            $data = Locations::with([]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){ $btn = $row->id; return $btn; })

                   ->addColumn('action', function($item){

$editlink = "<a href='".route('locations.editing', ['id' => $item->id])."' title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>";
$showlink = "<a href='".route('locations.showing', ['id' => $item->id])."' title='Show'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>";
$deleelink = "<a href='".route('locations.deleting', ['id' => $item->id])."' title='Delete'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>";


$btn = ''.$editlink.''.$showlink.''.$deleelink;
                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }

 }
}
