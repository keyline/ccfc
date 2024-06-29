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
    <form method="POST" action="" id="imageForm" enctype="multipart/form-data">
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
          <label for="imageUpload" class="col-md-4 col-lg-3 col-form-label">Images</label>
          <div class="col-md-8 col-lg-9">
            <input type="file" name="image_name" class="form-control" id="imageUpload" accept="image/*" <?=((empty($row))?'required':'')?>>
            <p><small class="text-primary">(Width : 827px & height : 1169px)</small></p>
            <?php if($image_name != ''){?>
              <img src="<?=env('UPLOADS_URL').$image_name?>" alt="<?=$title?>" style="width: 100px; height: 100px;" class="img-thumbnail">
            <?php }?>
            <div id="message"></div>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
  </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#imageForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        
        const fileInput = $('#imageUpload')[0];
        const file = fileInput.files[0];
        const img = new Image();
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
        
        img.onload = function() {
            const width = img.width;
            const height = img.height;
            
            // Define your desired width and height
            const maxWidth = 827;
            const maxHeight = 1169;
            
            if (width <= maxWidth && height <= maxHeight) {
                $('#message').text('Image is valid and ready to be uploaded.');
                // You can now proceed with the form submission or any other logic
            } else {
                $('#message').text('Image dimensions are too large. Please upload an image with dimensions ' + maxWidth + 'x' + maxHeight + '.');
            }
        };
        
        img.onerror = function() {
            $('#message').text('Invalid image file.');
        };
    });
});
</script>
@endsection
@section('scripts')

@endsection