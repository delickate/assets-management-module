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
            <form action="{{ route('asset_maintenance.updating',['id' => $asset_maintenance->id]) }}" method="POST"  enctype="multipart/form-data">
@csrf

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Maintenance Date:</strong>
<input type='text' name='form_maintenance_date' value='{{ $asset_maintenance->maintenance_date }}' class='form-control datepicker' placeholder='form_maintenance_date'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Type:</strong>
<input type='text' name='form_type' value='{{ $asset_maintenance->type }}' class='form-control' placeholder='form_type'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Cost:</strong>
<input type='number' name='form_cost' min="0"   value='{{ $asset_maintenance->cost }}' class='form-control' placeholder='form_cost'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
<input type='text' name='form_remarks' value='{{ $asset_maintenance->remarks }}' class='form-control' placeholder='form_remarks'>
</div>
</div>
			
		
<div class='col-xs-12 col-sm-12 col-md-12'><div class='form-group'><strong>Assets:</strong><select class='form-control' name = 'form_asset_id' id = 'form_asset_id'> <option value=''></option><?php if($assets) { foreach($assets as $key => $val) { ?><option value='<?php echo $key; ?>' <?php echo ((isset($asset_maintenance->asset_id) && $asset_maintenance->asset_id == $key)?'selected="selected"':'') ?>><?php echo $val; ?></option><?php } } ?></select> <!-- {!! Form::select('form_asset_id', $assets, (isset($asset_maintenance->asset_id)?$asset_maintenance->asset_id:null), ['class' => 'some_css_class']) !!}  --></div></div>
</div>
<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('asset_maintenance.listing') }}" class='btn btn-primary'>Back</a>

</div>

</form>
@endsection
