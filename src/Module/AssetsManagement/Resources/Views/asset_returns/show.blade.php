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
<strong>Return Date:</strong>
{{ $asset_returns->return_date }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Condition:</strong>
{{ $asset_returns->condition }}
</div>
</div>
			
		
 
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Remarks:</strong>
{{ $asset_returns->remarks }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Asset_Assignment_Id:</strong>
{{ $asset_returns->asset_assignments->assigned_date }}
</div>
</div>
			
		
 

<a href="{{ route('asset_returns.listing') }}" class='btn btn-primary'>Back</a>
@endsection
