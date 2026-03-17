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
            <form action="{{ route('vendors.updating',['id' => $vendors->id]) }}" method="POST"  enctype="multipart/form-data">
@csrf

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Name:</strong>
<input type='text' name='form_name' value='{{ $vendors->name }}' class='form-control' placeholder='name'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Contact_Info:</strong>
<input type='text' name='form_contact_info' value='{{ $vendors->contact_info }}' class='form-control' placeholder='contact_info'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Address:</strong>
<input type='text' name='form_address' value='{{ $vendors->address }}' class='form-control' placeholder='address'>
</div>
</div>
			
		
</div>
<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('vendors.listing') }}" class='btn btn-primary'>Back</a>

</div>

</form>
@endsection
