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
<form method="method">
  <label>Import file</label>
  <input type="file" name="importfile" />
  <input type="submit" name="importSubmit" value="Import">
  
</form>
</div>
</div>
			
		
  

<a href="{{ route('asset_types.listing') }}" class='btn btn-primary'>Back</a>
@endsection
