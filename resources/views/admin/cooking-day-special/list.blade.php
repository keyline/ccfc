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
          <!-- <th>Title</th>
          <th>Description</th> -->
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($rows){ $sl=1; foreach($rows as $row){?>
          <tr>
            <td><?=$sl++?></td>
            <td><?=date_format(date_create($row->menu_date), "d-m-Y")?></td>
            <!-- <td><?=$row->title?></td>
            <td><?=$row->description?></td> -->
            <td>
              <?php if($row->image_name != ''){?>
                <img src="<?=env('UPLOADS_URL').$row->image_name?>" alt="<?=$row->title?>" style="width: 75px; height: 75px;" class="img-thumbnail">
              <?php }?>
            </td>
            <td>
              <a href="<?=url('admin/create/edit-dayspeciallist/' . $row->id)?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
              <?php if($row->status){?>
                <a href="<?=url('admin/create/deactive-dayspeciallist/' . $row->id)?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to deactive this day special menu ?');"><i class="fa fa-times"></i> Deactive</a>
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