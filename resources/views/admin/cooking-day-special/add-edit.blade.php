@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3><?=((empty($row))?'Add':'Edit')?> Cooking Day Special</h3>
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
  <div class="card-body">
    <?php
    if($row){
      $menu_date        = $row->menu_date;
      $title            = $row->title;
      $description      = $row->description;
      $image_name       = $row->image_name;
      $image_link       = $row->image_link;
    } else {
      $menu_date        = '';
      $title            = '';
      $description      = '';
      $image_name       = '';
      $image_link       = '';
    }
    ?>
    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
          <label for="menu_date" class="col-md-4 col-lg-3 col-form-label">Menu Date</label>
          <div class="col-md-8 col-lg-9">
            <input type="date" name="menu_date" class="form-control" id="menu_date" value="<?=$menu_date?>" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
          <div class="col-md-8 col-lg-9">
            <input type="text" name="title" class="form-control" id="title" value="<?=$title?>" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
          <div class="col-md-8 col-lg-9">
            <textarea name="description" class="form-control ckeditor" id="description"><?=$description?></textarea>
          </div>
        </div>
        <div class="row mb-3">
          <label for="image_name" class="col-md-4 col-lg-3 col-form-label">Images</label>
          <div class="col-md-8 col-lg-9">
            <input type="file" name="image_name" class="form-control" id="image_name" <?=((empty($row))?'required':'')?>>
            <?php if($image_name != ''){?>
              <img src="<?=env('UPLOADS_URL').$image_name?>" alt="<?=$title?>">
            <?php }?>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
  </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection
@section('scripts')

@endsection