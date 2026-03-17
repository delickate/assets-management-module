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
<strong>Name:</strong>
{{ $employees->name }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Department:</strong>
{{ $employees->department }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Designation:</strong>
{{ $employees->designation }}
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Email:</strong>
{{ $employees->email }}
</div>
</div>
			

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Phone:</strong>
{{ $employees->phone }}
</div>
</div>
			
		
  

<a href="{{ route('employees.listing') }}" class='btn btn-primary'>Back</a>
@endsection
