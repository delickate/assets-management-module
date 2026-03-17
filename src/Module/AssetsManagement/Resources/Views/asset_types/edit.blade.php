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
            <form action="{{ route('asset_types.updating',['id' => $asset_types->id]) }}" method="POST"  enctype="multipart/form-data">
@csrf
 <div class='row'>
<div class='col-xs-12 col-sm-12 col-md-12'>
<div class='form-group'>
<strong>Name:</strong>
<input type='text' name='form_name' value='{{ $asset_types->name }}' class='form-control' placeholder='form_name'>
</div>
</div>
			
		
</div>
<div class='col-xs-12 col-sm-12 col-md-12 text-center'>
<button type='submit' class='btn btn-primary'>Submit</button>
    <a href="{{ route('asset_types.listing') }}" class='btn btn-primary'>Back</a>
</form>
</div>@endsection
