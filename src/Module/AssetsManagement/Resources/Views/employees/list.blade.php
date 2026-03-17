@extends('layouts.app')

@section('content')


<?php if(Session::has('success_message')){ ?>
  <div class='alert alert-success alert-dismissable text-left'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <i class='icon fa fa-check'></i>Success: <?php echo Session::get('success_message');?>
  </div>

<?php }elseif(Session::has('error_message')){ ?>
  <div class='alert alert-danger alert-dismissable text-left'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <i class='icon fa fa-ban'></i>Error: <?php echo Session::get('error_message');?>
  </div> 
<?php } ?>

 <a href="{{ route('employees.adding') }}" class='btn btn-success btn-sm' title='Add New '>
    <i class='fa fa-plus' aria-hidden='true'></i> Add 
</a>

<div class="col-md-3">
    <a href="{{ asset('storage/sample_files/assets_management_module/employees/sample_file.xlsx'); }}">download sample file</a>
</div>

<table class="table table-bordered">
                    <thead >
     <tr>
        <th>#</th> 
 <th>Name</th>
 <th>Department</th>
 <th>Designation</th>
 <th>Email</th>
 <th>Phone</th>
<th>Actions</th>
     </tr>
  </thead>
<tbody>

@foreach($employees as $item)
   <tr>
     <td>{{ $loop->iteration }}</td>
 <td>{{ $item->name }}</td>
 <td>{{ $item->department }}</td>
 <td>{{ $item->designation }}</td>
 <td>{{ $item->email }}</td>
 <td>{{ $item->phone }}</td>

     <td>
         <a href="{{ route('employees.editing', ['id' => $item->id]) }}" title='Edit' class="text-xs font-semibold leading-tight text-slate-400"><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>
         <a href="{{ route('employees.showing', ['id' => $item->id]) }}" title='Edit' class="text-xs font-semibold leading-tight text-slate-400"><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>
	     <a href="{{ route('employees.deleting', ['id' => $item->id]) }}" title='Edit'  onclick='return confirm(&quot;Confirm delete?&quot;)' class="text-xs font-semibold leading-tight text-slate-400"><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>
	</td>
  </tr>
 @endforeach

</tbody> 
    
</table>

<div class='pagination-wrapper'> {!! $employees->appends(['search' => Request::get('search')])->render() !!} </div>

@endsection	
