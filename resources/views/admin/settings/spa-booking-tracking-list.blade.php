@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3>Spa Booking Trackings</h3>
    </div>
</div>
@endcan
@if (session('status'))
    <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
@if (session('error_message'))
    <h6 class="alert alert-danger">{{ session('error_message') }}</h6>
@endif
<div class="card">
  <div class="card-body">
    <table id="example" class="table table-bordered table-striped table-hover datatable datatable-ContentBlock">
      <thead>
        <tr>
          <th>#</th>
          <th>Member Code</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <?php if($spaBookings){ $sl=1; foreach($spaBookings as $row){?>
          <tr>
            <td><?=$sl++?></td>
            <td><?=$row->member_code?></td>
            <td><?=$row->name?></td>
            <td><?=$row->email?></td>
            <td><?=$row->phone?></td>
            <td><?=date_format(date_create($row->created_at), "d-m-Y h:i A")?></td>
          </tr>
        <?php } } ?>
      </tbody>
    </table>
  </div>
</div>
@endsection
@section('scripts')

@endsection