@extends('layouts.app')
@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<?php if(Session::has('success_message')){ ?>
  <div class='alert alert-success alert-dismissable text-left'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <i class='icon fa fa-check'></i>Success: <?php echo Session::get('success_message');?>
  </div>

<?php }elseif(Session::has('error_message')){ ?>
  <div class='alert alert-danger alert-dismissable text-left'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <i class='icon fa fa-ban'></i>Error: <?php echo Session::get('error_message');?>
  </div> 
<?php } ?>

 <a href="{{ route('assets.adding') }}" class='btn btn-success btn-sm' title='Add New '>
    <i class='fa fa-plus' aria-hidden='true'></i> Add 
</a>
<table class='table table-bordered data-table'>

        <thead>

            <tr>

<th>#</th> 
 <th>asset_tag</th>
 <th>asset_name</th>
 <th>brand</th>
 <th>model</th>
 <th>serial_number</th>
 <th>purchase_date</th>
 <th>purchase_cost</th>
 <th>warranty_expiry_date</th>
 <th>warranty_expiry_date</th>
 <th>remarks</th>
 <th>vendor_id</th>
 <th>location_id</th>
 <th>asset_type_id</th>
<th>Actions</th> </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

<script type="text/javascript">

$(function () 
{
  var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('assets.yajra_data') }}",
                      columns: [
                                {data:'id', name:'id'},
{data:'asset_tag', name:'asset_tag'},
{data:'asset_name', name:'asset_name'},
{data:'brand', name:'brand'},
{data:'model', name:'model'},
{data:'serial_number', name:'serial_number'},
{data:'purchase_date', name:'purchase_date'},
{data:'purchase_cost', name:'purchase_cost'},
{data:'warranty_expiry_date', name:'warranty_expiry_date'},
{data:'warranty_expiry_date', name:'warranty_expiry_date'},
{data:'remarks', name:'remarks'},
{data:'vendor_id', name:'vendor_id'},
{data:'location_id', name:'location_id'},
{data:'asset_type_id', name:'asset_type_id'},

                                {data: 'action', name: 'action', orderable: false, searchable: false},
                              ]
              });

});

</script>

@endsection
