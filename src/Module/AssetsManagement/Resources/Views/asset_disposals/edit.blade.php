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
            <form action="{{ route('asset_disposals.updating',['id' => $asset_disposals->id]) }}" method="POST"  enctype="multipart/form-data">
@csrf


<div class='col-xs-12 col-sm-12 col-md-12'><div class='form-group'><strong>Assets:</strong><select class='form-control' name = 'form_asset_id' id = 'form_asset_id'> <option value=''></option><?php if($assets) { foreach($assets as $key => $val) { ?><option value='<?php echo $key; ?>' <?php echo ((isset($asset_disposals->asset_id) && $asset_disposals->asset_id == $key)?'selected="selected"':'') ?>><?php echo $val; ?></option><?php } } ?></select> <!-- {!! Form::select('form_asset_id', $assets, (isset($asset_disposals->asset_id)?$asset_disposals->asset_id:null), ['class' => 'some_css_class']) !!}  --></div></div>

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Disposal Date:</strong>
<input type='text' name='form_disposal_date' value='{{ $asset_disposals->disposal_date }}' class='form-control datepicker' placeholder='disposal_date'>
</div>
</div>
			

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Reason:</strong>
<input type='text' name='form_reason' value='{{ $asset_disposals->reason }}' class='form-control' placeholder='reason'>
</div>
</div>
			

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Scrap Value:</strong>
<input type='number' name='form_scrap_value' value='{{ $asset_disposals->scrap_value }}' class='form-control' placeholder='scrap_value'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
<input type='text' name='form_remarks' value='{{ $asset_disposals->remarks }}' class='form-control' placeholder='remarks'>
</div>
</div>
			
		

</div>
<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('asset_disposals.listing') }}" class='btn btn-primary'>Back</a>

</div>
</form>
@endsection
