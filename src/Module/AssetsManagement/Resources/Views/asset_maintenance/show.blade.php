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
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Maintenance_Date:</strong>
{{ $asset_maintenance->maintenance_date }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Type:</strong>
{{ $asset_maintenance->type }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Cost:</strong>
{{ $asset_maintenance->cost }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
{{ $asset_maintenance->remarks }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Asset_Id:</strong>
{{ $asset_maintenance->assets->asset_name }}
</div>
</div>
			
		
 

<a href="{{ route('asset_maintenance.listing') }}" class='btn btn-primary'>Back</a>
@endsection
