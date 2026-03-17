<?php
namespace Modules\AssetsManagement\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Modules\AssetsManagement\Repositories\Interfaces\VendorsRepositoryInterface;
use Modules\AssetsManagement\Entities\Vendors;


use DB;
use DataTables;

class VendorsController extends Controller
{
    protected $vendorsRepository;

    public function __construct(VendorsRepositoryInterface $vendorsRepository)
    {
        $this->vendorsRepository = $vendorsRepository;
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        $data['title'] = "Vendors list"; 

        //if (!empty($keyword))
        //{

          //  $vendors = Vendors::with([])->get();
           
        //}else{
          //      $vendors = Vendors::with([])->paginate($perPage);
          //   }

		//$data['vendors'] = $vendors; 

        $data['vendors'] = $this->vendorsRepository->getAll($perPage, $keyword);

        return view('assetsmanagement::vendors/list', $data);
    }
    
    public function create()
    {
       $data = array();

       	$data['title'] = "Vendors add"; 

       return view('assetsmanagement::vendors/add', $data);
   }

   public function store(Request $request)
   {

     $data = array();

     $request->validate([
                            'form_name' => 'required',
'form_contact_info' => 'required',
'form_address' => 'required',

                        ]);

     $vendors = new Vendors;
     $vendors->name = $request->post('form_name');
$vendors->contact_info = $request->post('form_contact_info');
$vendors->address = $request->post('form_address');

     

     $data = [
            'name'        => $request->post('form_name'),'contact_info'        => $request->post('form_contact_info'),'address'        => $request->post('form_address'),
        ];

     //if($vendors->save())
     if ($this->vendorsRepository->create($data))
     {
        return redirect()->route('vendors.listing')->with('success_message', 'Password has been saved successfully.');
     }else{
             return redirect()->route('vendors.listing')->with('error_message', 'Error while saving record.');
             //App::abort(500, 'Error');
         }
   }

   public function show(Request $request,$id)
   {
     $data = array();
     //$data['vendors']=Vendors::with([])->find($id);
     $data['title'] = "Vendors show"; 
     $data['vendors'] = $this->vendorsRepository->findById($id);

     return view('assetsmanagement::vendors/show', $data);
  }

  public function edit($id)
  {
     $data = array();
	
     $data['title'] = "Vendors edit"; 		

     //$data['vendors']= Vendors::find($id);

     $data['vendors'] = $this->vendorsRepository->findById($id);

     return view('assetsmanagement::vendors/edit', $data);

  }

  public function update(Request $request,$id)
  {

    $data = array();

    $request->validate(['form_name' => 'required',
'form_contact_info' => 'required',
'form_address' => 'required',
]);

    $vendors=Vendors::find($id);

    $vendors->name = $request->post('form_name');
$vendors->contact_info = $request->post('form_contact_info');
$vendors->address = $request->post('form_address');


    $data = [
            'name'        => $request->post('form_name'),'contact_info'        => $request->post('form_contact_info'),'address'        => $request->post('form_address'),
        ];

    //if($vendors->save())
    if ($this->vendorsRepository->update($id, $data))
    {
       return redirect()->route('vendors.listing')->with('success_message', 'Record has updated successfully.');
    }else{
           return redirect()->route('vendors.listing')->with('error_message', 'Error while updating record.');
           //App::abort(500, 'Error');
         }
  }

  public function destroy($id)
  {

    //$vendors=Vendors::find($id);
    
    //if($vendors->delete())
    if ($this->vendorsRepository->delete($id))
    {
       return redirect()->route('vendors.listing')->with('success','User deleted successfully.');
    
    }else{
           return redirect()->route('vendors.listing')->with('error_message', 'Error while deleting record.');
           //App::abort(500, 'Error');
         }
  }

#yajra
 public function yajra_index(Request $request)
    {
        
       $data = array();
        return view('assetsmanagement::vendors/yajralisting', $data);
    }

    public function yajra_data(Request $request)
    {

        if ($request->ajax()) {
            
            
            $data = Vendors::with([]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){ $btn = $row->id; return $btn; })

                   ->addColumn('action', function($item){

$editlink = "<a href='".route('vendors.editing', ['id' => $item->id])."' title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>";
$showlink = "<a href='".route('vendors.showing', ['id' => $item->id])."' title='Show'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>";
$deleelink = "<a href='".route('vendors.deleting', ['id' => $item->id])."' title='Delete'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>";


$btn = ''.$editlink.''.$showlink.''.$deleelink;
                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }

 }
}
