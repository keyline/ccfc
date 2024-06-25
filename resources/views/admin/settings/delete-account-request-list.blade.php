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
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Request Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($deleteAccountRequests){ $sl=1; foreach($deleteAccountRequests as $row){?>
          <tr>
            <td><?=$sl++?></td>
            <td><?=$row->entity_name?></td>
            <td><?=$row->email?></td>
            <td><?=$row->phone?></td>
            <td><?=date_format(date_create($row->created_at), "d-m-Y h:i A")?></td>
            <td><?php
              $approve_date = (($row->approve_date != '')?date_format(date_create($row->created_at), "d-m-Y h:i A"):'');
              if($row->status == 0){
                echo '<h6 class="badge badge-warning">Pending</h6>';
              } elseif($row->status == 1){
                echo '<h6 class="text-success">Approved</h6>';
                echo '<small class="badge badge-success">' + $approve_date + '</small>';
              } elseif($row->status == 3){
                echo '<h6 class="badge badge-danger">Rejected</h6>';
                echo '<small class="badge badge-danger">' + $approve_date + '</small>';
              }
            ?></td>
            <td>
              <?php if($row->status == 0){?>
                <a href="<?=url('admin/create/action-deleteaccountrequests/' . $row->id.'/1')?>" class="btn btn-success btn-sm" onclick="return confirm('Do you want to approve this request ?');"><i class="fa fa-check"></i> Approve</a>
                <a href="<?=url('admin/create/action-deleteaccountrequests/' . $row->id.'/3')?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to reject this request ?');"><i class="fa fa-times"></i> Reject</a>
              <?php }?>
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