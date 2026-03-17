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
<strong>Asset_Tag:</strong>
{{ $assets->asset_tag }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Asset_Name:</strong>
{{ $assets->asset_name }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Brand:</strong>
{{ $assets->brand }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Model:</strong>
{{ $assets->model }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Serial_Number:</strong>
{{ $assets->serial_number }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Purchase_Date:</strong>
{{ $assets->purchase_date }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Purchase_Cost:</strong>
{{ $assets->purchase_cost }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Warranty_Expiry_Date:</strong>
{{ $assets->warranty_expiry_date }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Warranty_Expiry_Date:</strong>
{{ $assets->warranty_expiry_date }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
{{ $assets->remarks }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Vendor_Id:</strong>
{{ $assets->vendors->name }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Location_Id:</strong>
{{ $assets->locations->name }}
</div>
</div>
			
		
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Asset_Type_Id:</strong>
{{ $assets->asset_types->name }}
</div>
</div>
			
		
 

<a href="{{ route('assets.listing') }}" class='btn btn-primary'>Back</a>
@endsection
