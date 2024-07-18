@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3>Deleet Account Requests</h3>
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
          <th>Member Name</th>
          <th>Member Code</th>
          <th>Email</th>
          <th>Phone 1</th>
          <th>Phone 2</th>
          <th>Phone 3</th>
          <th>Request Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){?>
          <tr>
            <td><?=$sl++?></td>
            <td><?=$row->rows?></td>
            <td><?=$row->member_code?></td>
            <td><?=$row->member_email?></td>
            <td><?=$row->member_phone1?></td>
            <td><?=$row->member_phone2?></td>
            <td><?=$row->member_phone3?></td>
            <td><?=date_format(date_create($row->created_at), "d-m-Y h:i A")?></td>
            <td>
              <a target="_blank" href="<?=url('admin/create/detail-profileupdaterequests/' . $row->id)?>" class="badge badge-info"><i class="fa fa-info-circle"></i> View Details</a>
            </td>
          </tr>
        <?php } } ?>
      </tbody>
    </table>
  </div>
</div>
@endsection
@section('scripts')

@endsection