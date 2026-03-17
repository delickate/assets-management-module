@extends('layouts.app')

@section('content')


<?php  if(Session::has('success_message')){ ?>
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
<div class="col-md-3">
 <a href="{{ route('asset_types.adding') }}" class='btn btn-success btn-sm' title='Add New '>
    <i class='fa fa-plus' aria-hidden='true'></i> Add 
</a>
</div>

<div class="col-md-3">
    <a href="{{ asset('storage/sample_files/assets_management_module/types/sample_file.xlsx'); }}">download sample file</a>
</div>

<div class="col-md-3">
    <a href="{{ route('asset_types.importing') }}">Import data</a>
</div>

<table class='table'>
  <thead>
     <tr>
        <th>#</th> 
 <th>name</th>
<th>Actions</th>
     </tr>
  </thead>
<tbody>

@foreach($asset_types as $item)
   <tr>
     <td>{{ $loop->iteration }}</td>
 <td>{{ $item->name }}</td>

     <td>
         <a href="{{ route('asset_types.editing', ['id' => $item->id]) }}" title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>
         <a href="{{ route('asset_types.showing', ['id' => $item->id]) }}" title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>
	     <a href="{{ route('asset_types.deleting', ['id' => $item->id]) }}" title='Edit'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>
	</td>
  </tr>
 @endforeach

</tbody> 
    
</table>

<div class='pagination-wrapper'> {!! $asset_types->appends(['search' => Request::get('search')])->render() !!} </div>

@endsection	
