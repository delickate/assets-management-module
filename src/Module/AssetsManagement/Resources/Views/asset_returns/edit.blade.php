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
            <form action="{{ route('asset_returns.updating',['id' => $asset_returns->id]) }}" method="POST"  enctype="multipart/form-data">
@csrf

<div class='col-xs-12 col-sm-12 col-md-12'><div class='form-group'><strong>Asset_Assignments:</strong><select class='form-control' name = 'form_asset_assignment_id' id = 'form_asset_assignment_id'> <option value=''></option><?php if($asset_assignments) { foreach($asset_assignments as $key => $val) { ?><option value='<?php echo $key; ?>' <?php echo ((isset($asset_returns->asset_assignment_id) && $asset_returns->asset_assignment_id == $key)?'selected="selected"':'') ?>><?php echo $val; ?></option><?php } } ?></select> <!-- {!! Form::select('form_asset_assignment_id', $asset_assignments, (isset($asset_returns->asset_assignment_id)?$asset_returns->asset_assignment_id:null), ['class' => 'some_css_class']) !!}  --></div></div>

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Return Date:</strong>
<input type='text' name='form_return_date' value='{{ $asset_returns->return_date }}' class='form-control datepicker' placeholder='form_return_date'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Condition:</strong>
<input type='text' name='form_condition' value='{{ $asset_returns->condition }}' class='form-control' placeholder='form_condition'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
<input type='text' name='form_remarks' value='{{ $asset_returns->remarks }}' class='form-control' placeholder='form_remarks'>
</div>
</div>
			
		

</div>
<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('asset_returns.listing') }}" class='btn btn-primary'>Back</a>

</div>
</form>
@endsection
