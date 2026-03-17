@extends('layouts.app')
@section('content')

@if ($errors->any())
  <ul class='alert alert-danger'>
      @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
      @endforeach
  </ul>
@endif
 <div class='row'>
    <form action="{{ route('asset_assignments.saving') }}" method="POST" enctype="multipart/form-data">
    @csrf
 
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Assigned_Date:</strong>
<input type='text' name='form_assigned_date' value='{{ old('form_assigned_date') }}' class='form-control' placeholder='form_assigned_date'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Expected_Return_Date:</strong>
<input type='text' name='form_expected_return_date' value='{{ old('form_expected_return_date') }}' class='form-control' placeholder='form_expected_return_date'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Returned_Date:</strong>
<input type='text' name='form_returned_date' value='{{ old('form_returned_date') }}' class='form-control' placeholder='form_returned_date'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
<input type='text' name='form_remarks' value='{{ old('form_remarks') }}' class='form-control' placeholder='form_remarks'>
</div>
</div>
			


<div class='col-xs-12 col-sm-12 col-md-12'><div class='form-group'><strong>Assets:</strong><select class='form-control' name = 'form_asset_id' id = 'form_asset_id'> <option value=''></option><?php if($assets) { foreach($assets as $key => $val) { ?><option value='<?php echo $key; ?>' <?php echo ((isset($asset_assignments->asset_id) && $asset_assignments->asset_id == $key)?'selected="selected"':'') ?>><?php echo $val; ?></option><?php } } ?></select> <!-- {!! Form::select('form_asset_id', $assets, (isset($asset_assignments->asset_id)?$asset_assignments->asset_id:null), ['class' => 'some_css_class']) !!}  --></div></div>

<div class='col-xs-12 col-sm-12 col-md-12'><div class='form-group'><strong>Asset_Types:</strong><select class='form-control' name = 'form_asset_type_id' id = 'form_asset_type_id'> <option value=''></option><?php if($asset_types) { foreach($asset_types as $key => $val) { ?><option value='<?php echo $key; ?>' <?php echo ((isset($asset_assignments->asset_type_id) && $asset_assignments->asset_type_id == $key)?'selected="selected"':'') ?>><?php echo $val; ?></option><?php } } ?></select> <!-- {!! Form::select('form_asset_type_id', $asset_types, (isset($asset_assignments->asset_type_id)?$asset_assignments->asset_type_id:null), ['class' => 'some_css_class']) !!}  --></div></div>
</div>
<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('asset_assignments.listing') }}" class='btn btn-primary'>Back</a>

</div>

</form>
@endsection
