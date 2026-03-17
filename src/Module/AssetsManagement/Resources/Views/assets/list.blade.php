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

 <a href="{{ route('assets.adding') }}" class='btn btn-success btn-sm' title='Add New '>
    <i class='fa fa-plus' aria-hidden='true'></i> Add 
</a>

<div class="col-md-3">
    <a href="{{ asset('storage/sample_files/assets_management_module/assets/sample_file.xlsx'); }}">download sample file</a>
</div>

<table class='table'>
  <thead>
     <tr>
        <th>#</th> 
 <th>asset tag</th>
 <th>asset name</th>
 <th>brand</th>
 <th>model</th>
 <th>serial number</th>
 <th>purchase date</th>
 <th>purchase cost</th>
 <th>warranty expiry date</th>
 <th>warranty expiry date</th>
 <th>remarks</th>
 <th>vendors</th>
 <th>locations</th>
 <th>asset types</th>
<th>Actions</th>
     </tr>
  </thead>
<tbody>

@foreach($assets as $item)
   <tr>
     <td>{{ $loop->iteration }}</td>
 <td>{{ $item->asset_tag }}</td>
 <td>{{ $item->asset_name }}</td>
 <td>{{ $item->brand }}</td>
 <td>{{ $item->model }}</td>
 <td>{{ $item->serial_number }}</td>
 <td>{{ $item->purchase_date }}</td>
 <td>{{ $item->purchase_cost }}</td>
 <td>{{ $item->warranty_expiry_date }}</td>
 <td>{{ $item->warranty_expiry_date }}</td>
 <td>{{ $item->remarks }}</td>
 <td>{{ optional($item->vendors)->name }}</td>
 <td>{{ optional($item->locations)->name }}</td>
 <td>{{ optional($item->asset_types)->name }}</td>

     <td>
         <a href="{{ route('assets.editing', ['id' => $item->id]) }}" title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a>
         <a href="{{ route('assets.showing', ['id' => $item->id]) }}" title='Edit'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> show</button></a>
	     <a href="{{ route('assets.deleting', ['id' => $item->id]) }}" title='Edit'  onclick='return confirm(&quot;Confirm delete?&quot;)'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Delete</button></a>
	</td>
  </tr>
 @endforeach

</tbody> 
    
</table>

<div class='pagination-wrapper'> {!! $assets->appends(['search' => Request::get('search')])->render() !!} </div>

@endsection	
