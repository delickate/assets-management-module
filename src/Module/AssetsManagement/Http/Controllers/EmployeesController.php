<?php
namespace Modules\AssetsManagement\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Modules\AssetsManagement\Repositories\Interfaces\EmployeesRepositoryInterface;
use Modules\AssetsManagement\Entities\Employees;


use DB;
use DataTables;

class EmployeesController extends Controller
{
    protected $employeesRepository;

    public function __construct(EmployeesRepositoryInterface $employeesRepository)
    {
        $this->employeesRepository = $employeesRepository;
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 30;
        $data    = array();

        //if (!empty($keyword))
        //{

          //  $employees = Employees::with([])->get();
           
        //}else{
          //      $employees = Employees::with([])->paginate($perPage);
          //   }

		$data['title'] = "Employees list"; 

        $data['employees'] = $this->employeesRepository->getAll($perPage, $keyword);

        return view('assetsmanagement::employees/list', $data);
    }
    
    public function create()
    {
       $data = array();

       	$data['title'] = "Employees add"; 

       return view('assetsmanagement::employees/add', $data);
   }

   public function store(Request $request)
   {

     $data = array();

     $request->validate([
                            'form_name' => 'required',
'form_department' => 'required',
'form_designation' => 'required',
'form_email' => 'required',
'form_phone' => 'required',

                        ]);

     $employees = new Employees;
     $employees->name = $request->post('form_name');
$employees->department = $request->post('form_department');
$employees->designation = $request->post('form_designation');
$employees->email = $request->post('form_email');
$employees->phone = $request->post('form_phone');

     

     $data = [
            'name'        => $request->post('form_name'),'department'        => $request->post('form_department'),'designation'        => $request->post('form_designation'),'email'        => $request->post('form_email'),'phone'        => $request->post('form_phone'),
        ];

     //if($employees->save())
     if ($this->employeesRepository->create($data))
     {
        return redirect()->route('employees.listing')->with('success_message', 'Password has been saved successfully.');
     }else{
             return redirect()->route('employees.listing')->with('error_message', 'Error while saving record.');
             //App::abort(500, 'Error');
         }
   }

   public function show(Request $request,$id)
   {
     $data = array();
     $data['title'] = "Employees detail"; 
     //$data['employees']=Employees::with([])->find($id);
     $data['employees'] = $this->employeesRepository->findById($id);

     return view('assetsmanagement::employees/show', $data);
  }

  public function edit($id)
  {
     $data = array();
	
     $data['title'] = "Employees edit"; 		

     //$data['employees']= Employees::find($id);

     $data['employees'] = $this->employeesRepository->findById($id);

     return view('assetsmanagement::employees/edit', $data);

  }

  public function update(Request $request,$id)
  {

    $data = array();

    $request->validate(['form_name' => 'required',
'form_department' => 'required',
'form_designation' => 'required',
'form_email' => 'required',
'form_phone' => 'required',
]);

    $employees=Employees::find($id);

    $employees->name = $request->post('form_name');
$employees->department = $request->post('form_department');
$employees->designation = $request->post('form_designation');
$employees->email = $request->post('form_email');
$employees->phone = $request->post('form_phone');


    $data = [
            'name'        => $request->post('form_name'),'department'        => $request->post('form_department'),'designation'        => $request->post('form_designation'),'email'        => $request->post('form_email'),'phone'        => $request->post('form_phone'),
        ];

    //if($employees->save())
    if ($this->employeesRepository->update($id, $data))
    {
       return redirect()->route('employees.listing')->with('success_message', 'Record has updated successfully.');
    }else{
           return redirect()->route('employees.listing')->with('error_message', 'Error while updating record.');
           //App::abort(500, 'Error');
         }
  }

  public function destroy($id)
  {

    //$employees=Employees::find($id);
    
    //if($employees->delete())
    if ($this->employeesRepository->delete($id))
    {
       return redirect()->route('employees.listing')->with('success','User deleted successfully.');
    
    }else{
           return redirect()->route('employees.listing')->with('error_message', 'Error while deleting record.');
           //App::abort(500, 'Error');
         }
  }

#yajra
 public function yajra_index(Request $request)
    {
        
       $data = array();
        return view('assetsmanagement::employees/yajralisting', $data);
    }

    public function yajra_data(Request $request)
    {

        if ($request->ajax()) {
            
            
            $data = Employees::with([]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){ $btn = $row->id; return $btn; })

                   ->addColumn('action', function($item){

$editlink = "<a href='".route('employees.editing', ['id' => $item->id])."' title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>";
$showlink = "<a href='".route('employees.showing', ['id' => $item->id])."' title='Show'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>";
$deleelink = "<a href='".route('employees.deleting', ['id' => $item->id])."' title='Delete'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>";


$btn = ''.$editlink.''.$showlink.''.$deleelink;
                            return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);

        }

 }
}
