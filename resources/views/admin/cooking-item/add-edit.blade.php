@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3><?=((empty($row))?'Add':'Edit')?> Whats Cooking Item</h3>
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
      $category_id  = $row->category_id;
      $name         = $row->name;
      $rate         = $row->rate;
    } else {
      $category_id  = '';
      $name         = '';
      $rate         = '';
    }
    ?>
    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
          <label for="category_id" class="col-md-4 col-lg-3 col-form-label">Category</label>
          <div class="col-md-8 col-lg-9">
            <select class="form-control" name="category_id" id="category_id">
              <option value="" selected>Select Category</option>
              <?php if($cats){ foreach($cats as $cat){?>
                <option value="<?=$cat->id?>" <?=(($category_id == $cat->id)?'selected':'')?>><?=$cat->name?> (<?=$cat->for_cat?>)</option>
              <?php } } ?>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
          <div class="col-md-8 col-lg-9">
            <input type="text" name="name" class="form-control" id="name" value="<?=$name?>" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="rate" class="col-md-4 col-lg-3 col-form-label">Rate</label>
          <div class="col-md-8 col-lg-9">
            <input type="text" name="rate" class="form-control" id="rate" value="<?=$rate?>" required>
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