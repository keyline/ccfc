@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3>Cooking Day Special</h3>
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
    <h5>
      <a href="<?=url('admin/create/add-dayspeciallist/')?>" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add New</a>
    </h5>
  </div>
  <div class="card-body">
    <table id="example" class="table table-bordered table-striped table-hover datatable datatable-ContentBlock">
      <thead>
        <tr>
          <th>#</th>
          <th>Menu Date</th>
          <th>Title</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){?>
          <tr>
            <td><?=$sl++?></td>
            <td><?=$row->menu_date?></td>
            <td><?=$row->title?></td>
            <td><?=$row->description?></td>
            <td>
              <a href="<?=url('admin/create/edit-dayspeciallist/' . $row->id)?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
            </td>
          </tr>
        <?php } } ?>
      </tbody>
    </table>
  </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection
@section('scripts')

@endsection