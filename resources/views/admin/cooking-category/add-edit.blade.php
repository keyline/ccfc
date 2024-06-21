@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3><?=((empty($row))?'Add':'Edit')?> Whats Cooking Category</h3>
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
    <?php
    if($row){
      $for_cat  = $row->for_cat;
      $name     = $row->name;
    } else {
      $for_cat  = '';
      $name     = '';
    }
    ?>
    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
          <label for="for_cat" class="col-md-4 col-lg-3 col-form-label">Category For</label>
          <div class="col-md-8 col-lg-9">
            <span style="margin-right: 10px;"><input type="radio" name="for_cat" id="for_cat1" value="FOOD & BEVERAGES" <?=(($for_cat == 'FOOD & BEVERAGES')?'checked':'')?> required> <label for="for_cat1">FOOD & BEVERAGES</label></span>
            <span style="margin-right: 10px;"><input type="radio" name="for_cat" id="for_cat2" value="CLUB KITCHEN" <?=(($for_cat == 'CLUB KITCHEN')?'checked':'')?> required> <label for="for_cat2">CLUB KITCHEN</label></span>
          </div>
        </div>
        <div class="row mb-3">
          <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
          <div class="col-md-8 col-lg-9">
            <input type="text" name="name" class="form-control" id="name" value="<?=$name?>" required>
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