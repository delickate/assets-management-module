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
<strong>Disposal_Date:</strong>
{{ $asset_disposals->disposal_date }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Reason:</strong>
{{ $asset_disposals->reason }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Scrap_Value:</strong>
{{ $asset_disposals->scrap_value }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
{{ $asset_disposals->remarks }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Asset_Id:</strong>
{{ $asset_disposals->assets->asset_name }}
</div>
</div>
			
		
 

<a href="{{ route('asset_disposals.listing') }}" class='btn btn-primary'>Back</a>
@endsection
