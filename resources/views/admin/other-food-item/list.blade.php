@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3>Other Food Items</h3>
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
      <a href="<?=url('admin/create/add-otherfooditemlist/')?>" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add New</a>
    </h5>
  </div>
  <div class="card-body">
    <table id="example" class="table table-bordered table-striped table-hover datatable datatable-ContentBlock">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Validity</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){?>
          <tr>
            <td><?=$sl++?></td>
            <td><?=$row->name?></td>
            <td><?=date_format(date_create($row->validity), "d-m-Y")?></td>
            <td>
              <?php if($row->food_image != ''){?>
                <img src="<?=env('UPLOADS_URL').$row->food_image?>" alt="<?=$row->name?>" style="width: 75px; height: 75px;" class="img-thumbnail">
              <?php }?>
            </td>
            <td>
              <a href="<?=url('admin/create/edit-otherfooditemlist/' . $row->id)?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
              <?php if($row->status){?>
                <a href="<?=url('admin/create/deactive-otherfooditemlist/' . $row->id)?>" class="btn btn-danger btn-sm" onclick="retunn confirm('Do you want to deactive this outside food item ?');"><i class="fa fa-times"></i> Deactive</a>
              <?php } else {?>
                <span class="badge badge-danger">Already Deactivated</span>
              <?php } ?>
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