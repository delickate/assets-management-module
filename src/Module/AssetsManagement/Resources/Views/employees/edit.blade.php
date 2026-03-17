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
            <form action="{{ route('employees.updating',['id' => $employees->id]) }}" method="POST"  enctype="multipart/form-data">
@csrf

<?php echo $title; ?>
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Name:</strong>
<input type='text' name='form_name' value='{{ $employees->name }}' class='form-control' placeholder='name'>
</div>
</div>
			
		
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Department:</strong>
<input type='text' name='form_department' value='{{ $employees->department }}' class='form-control' placeholder='department'>
</div>
</div>
			
		
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Designation:</strong>
<input type='text' name='form_designation' value='{{ $employees->designation }}' class='form-control' placeholder='designation'>
</div>
</div>
			
		
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Email:</strong>
<input type='text' name='form_email' value='{{ $employees->email }}' class='form-control' placeholder='email'>
</div>
</div>
			
		
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Phone:</strong>
<input type='text' name='form_phone' value='{{ $employees->phone }}' class='form-control' placeholder='phone'>
</div>
</div>
			
		
</div>
<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('employees.listing') }}" class='btn btn-primary'>Back</a>
</form>
</div>@endsection
