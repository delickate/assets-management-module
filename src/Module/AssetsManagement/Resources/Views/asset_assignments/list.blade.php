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

 <a href="{{ route('asset_assignments.adding') }}" class='btn btn-success btn-sm' title='Add New '>
    <i class='fa fa-plus' aria-hidden='true'></i> Add 
</a>

<div class="col-md-3">
    <a href="{{ asset('storage/sample_files/assets_management_module/assets_assignments/sample_file.xlsx'); }}">download sample file</a>
</div>

<table class='table'>
  <thead>
     <tr>
        <th>#</th> 
 <th>assigned date</th>
 <th>expected return date</th>
 <th>returned date</th>
 <th>remarks</th>
 <th>asset</th>
 <th>asset_type</th>
<th>Actions</th>
     </tr>
  </thead>
<tbody>

@foreach($asset_assignments as $item)
   <tr>
     <td>{{ $loop->iteration }}</td>
 <td>{{ $item->assigned_date }}</td>
 <td>{{ $item->expected_return_date }}</td>
 <td>{{ $item->returned_date }}</td>
 <td>{{ $item->remarks }}</td>
 <td>{{ optional($item->Assets)->asset_name }}</td>
 <td>{{ optional($item->Asset_Types)->name }}</td>

     <td>
         <a href="{{ route('asset_assignments.editing', ['id' => $item->id]) }}" title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>
         <a href="{{ route('asset_assignments.showing', ['id' => $item->id]) }}" title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>
	     <a href="{{ route('asset_assignments.deleting', ['id' => $item->id]) }}" title='Edit'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>
	</td>
  </tr>
 @endforeach

</tbody> 
    
</table>

<div class='pagination-wrapper'> {!! $asset_assignments->appends(['search' => Request::get('search')])->render() !!} </div>

@endsection	
