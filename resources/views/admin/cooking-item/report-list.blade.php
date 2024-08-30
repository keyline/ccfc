@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3>Whats Cooking Item</h3>
    </div>
</div>
@endcan
@if (session('success_message'))
    <h6 class="alert alert-success">{{ session('success_message') }}</h6>
@endif
@if (session('error_message'))
    <h6 class="alert alert-danger">{{ session('error_message') }}</h6>
@endif
<div class="card">
  <div class="card-header">
    
  </div>
  <div class="card-body">
    <table id="example" class="table table-bordered table-striped table-hover datatable datatable-ContentBlock">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Member Code</th>
          <th>Bill Details</th>
          <th>Item Description</th>
          <th>Comments</th>
          <th>Report Date/Time</th>
        </tr>
      </thead>
      <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){?>
          <tr>
            <td><?=$sl++?></td>
            <td><?=$row->name?></td>
            <td><?=$row->user_code?></td>
            <td><?=$row->billdetails?></td>
            <td><?=$row->itemdesc?></td>
            <td><?=$row->comments?></td>
            <td><?=date_format(date_create($row->created_at), "M d, Y h:i A")?></td>
          </tr>
        <?php } } ?>
      </tbody>
    </table>
  </div>
</div>
@endsection
@section('scripts')

@endsection