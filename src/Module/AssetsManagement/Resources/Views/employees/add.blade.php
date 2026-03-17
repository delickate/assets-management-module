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
    <form action="{{ route('employees.saving') }}" method="POST" enctype="multipart/form-data">
    @csrf
<?php echo $title; ?>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Name:</strong>
<input type='text' name='form_name' value='{{ old('form_name') }}' class='form-control' placeholder='name'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Department:</strong>
<input type='text' name='form_department' value='{{ old('form_department') }}' class='form-control' placeholder='department'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Designation:</strong>
<input type='text' name='form_designation' value='{{ old('form_designation') }}' class='form-control' placeholder='designation'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Email:</strong>
<input type='text' name='form_email' value='{{ old('form_email') }}' class='form-control' placeholder='email'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Phone:</strong>
<input type='text' name='form_phone' value='{{ old('form_phone') }}' class='form-control' placeholder='phone'>
</div>
</div>
			
		
</div>
<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('employees.listing') }}" class='btn btn-primary'>Back</a>

</div>

</form>

@endsection
