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
    <form action="{{ route('assets.saving') }}" method="POST" enctype="multipart/form-data">
    @csrf

<div class='col-xs-12 col-sm-12 col-md-12'><div class='form-group'><strong>Vendors:</strong><select class='form-control' name = 'form_vendor_id' id = 'form_vendor_id'> <option value=''></option><?php if($vendors) { foreach($vendors as $key => $val) { ?><option value='<?php echo $key; ?>' <?php echo ((isset($assets->vendor_id) && $assets->vendor_id == $key)?'selected="selected"':'') ?>><?php echo $val; ?></option><?php } } ?></select> <!-- {!! Form::select('form_vendor_id', $vendors, (isset($assets->vendor_id)?$assets->vendor_id:null), ['class' => 'some_css_class']) !!}  --></div></div>

<div class='col-xs-12 col-sm-12 col-md-12'><div class='form-group'><strong>Locations:</strong><select class='form-control' name = 'form_location_id' id = 'form_location_id'> <option value=''></option><?php if($locations) { foreach($locations as $key => $val) { ?><option value='<?php echo $key; ?>' <?php echo ((isset($assets->location_id) && $assets->location_id == $key)?'selected="selected"':'') ?>><?php echo $val; ?></option><?php } } ?></select></div></div>

<div class='col-xs-12 col-sm-12 col-md-12'><div class='form-group'><strong>Asset_Types:</strong><select class='form-control' name = 'form_asset_type_id' id = 'form_asset_type_id'> <option value=''></option><?php if($asset_types) { foreach($asset_types as $key => $val) { ?><option value='<?php echo $key; ?>' <?php echo ((isset($assets->asset_type_id) && $assets->asset_type_id == $key)?'selected="selected"':'') ?>><?php echo $val; ?></option><?php } } ?></select> <!-- {!! Form::select('form_asset_type_id', $asset_types, (isset($assets->asset_type_id)?$assets->asset_type_id:null), ['class' => 'some_css_class']) !!}  --></div></div>

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Asset Tag:</strong>
<input type='text' name='form_asset_tag' value='{{ old('form_asset_tag') }}' class='form-control' placeholder='form_asset_tag'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Asset Name:</strong>
<input type='text' name='form_asset_name' value='{{ old('form_asset_name') }}' class='form-control' placeholder='form_asset_name'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Brand:</strong>
<input type='text' name='form_brand' value='{{ old('form_brand') }}' class='form-control' placeholder='form_brand'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Model:</strong>
<input type='text' name='form_model' value='{{ old('form_model') }}' class='form-control' placeholder='form_model'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Serial_Number:</strong>
<input type='text' name='form_serial_number' value='{{ old('form_serial_number') }}' class='form-control' placeholder='form_serial_number'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Purchase Date:</strong>
<input type='text' name='form_purchase_date' value='{{ old('form_purchase_date') }}' class='form-control datetimepicker'  placeholder='form_purchase_date'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Purchase Cost:</strong>
<input type='text' name='form_purchase_cost' value='{{ old('form_purchase_cost') }}' class='form-control  datetimepicker' placeholder='form_purchase_cost'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Warranty Expiry Date:</strong>
<input type='text' name='form_warranty_expiry_date' value='{{ old('form_warranty_expiry_date') }}' class='form-control  datetimepicker' placeholder='form_warranty_expiry_date'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Warranty Expiry Date:</strong>
<input type='text' name='form_warranty_expiry_date' value='{{ old('form_warranty_expiry_date') }}' class='form-control  datepicker' placeholder='form_warranty_expiry_date'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
<input type='text' name='form_remarks' value='{{ old('form_remarks') }}' class='form-control' placeholder='form_remarks'>
</div>
</div>
			
		


<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('assets.listing') }}" class='btn btn-primary'>Back</a>
</form>
</div>
@endsection
