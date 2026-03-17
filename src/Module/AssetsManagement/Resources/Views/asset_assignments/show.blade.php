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
<strong>Assigned_Date:</strong>
{{ $asset_assignments->assigned_date }}
</div>
</div>
			
		
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Expected_Return_Date:</strong>
{{ $asset_assignments->expected_return_date }}
</div>
</div>
			
		
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Returned_Date:</strong>
{{ $asset_assignments->returned_date }}
</div>
</div>
			
		
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
{{ $asset_assignments->remarks }}
</div>
</div>
			
		
  <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Asset_Id:</strong>
{{ $asset_assignments->assets->asset_name }}
</div>
</div>
			
		
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Asset_Type_Id:</strong>
{{ $asset_assignments->asset_types->name }}
</div>
</div>
			
		
 

<a href="{{ route('asset_assignments.listing') }}" class='btn btn-primary'>Back</a>
@endsection
