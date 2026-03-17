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
    <form action="{{ route('vendors.saving') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <?php echo $title; ?>
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Name:</strong>
<input type='text' name='form_name' value='{{ old('form_name') }}' class='form-control' placeholder='name'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Contact_Info:</strong>
<input type='text' name='form_contact_info' value='{{ old('form_contact_info') }}' class='form-control' placeholder='contact_info'>
</div>
</div>
			
		

<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Address:</strong>
<input type='text' name='form_address' value='{{ old('form_address') }}' class='form-control' placeholder='address'>
</div>
</div>
			
		
</div>
<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('vendors.listing') }}" class='btn btn-primary'>Back</a>

</div>

</form>

@endsection
