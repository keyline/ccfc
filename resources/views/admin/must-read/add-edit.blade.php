@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3><?=((empty($row))?'Add':'Edit')?> Must Read</h3>
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
      $title                      = $row->title;
      $description                = $row->description;
      $is_popup                   = $row->is_popup;
      $popup_validity_date        = $row->popup_validity_date;
      $popup_validity_time        = $row->popup_validity_time;
    } else {
      $title                      = '';
      $description                = '';
      $is_popup                   = 0;
      $popup_validity_date        = '';
      $popup_validity_time        = '';
    }
    ?>
    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
          <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
          <div class="col-md-8 col-lg-9">
            <input type="text" name="title" class="form-control" id="title" value="<?=$title?>" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
          <div class="col-md-8 col-lg-9">
            <textarea name="description" class="form-control ckeditor" id="description" required><?=$description?></textarea>
          </div>
        </div>
        <div class="row mb-3">
          <label for="is_popup" class="col-md-4 col-lg-3 col-form-label">Is Popup</label>
          <div class="col-md-8 col-lg-9">
            <span style="margin-right: 10px;"><input type="radio" name="is_popup" id="is_popup1" value="1" <?=(($is_popup == 1)?'checked':'')?> required> <label for="is_popup1">YES</label></span>
            <span style="margin-right: 10px;"><input type="radio" name="is_popup" id="is_popup2" value="0" <?=(($is_popup == 0)?'checked':'')?> required> <label for="is_popup2">NO</label></span>
          </div>
        </div>

        <div class="row mb-3 is-popup-yes" style="display: none;">
          <label for="popup_validity_date" class="col-md-4 col-lg-3 col-form-label">Validity Date</label>
          <div class="col-md-8 col-lg-9">
            <input type="date" name="popup_validity_date" class="form-control" id="popup_validity_date" value="<?=$popup_validity_date?>" min="<?=date('Y-m-d')?>">
          </div>
        </div>
        <div class="row mb-3 is-popup-yes" style="display: none;">
          <label for="popup_validity_time" class="col-md-4 col-lg-3 col-form-label">Validity Time</label>
          <div class="col-md-8 col-lg-9">
            <input type="time" name="popup_validity_time" class="form-control" id="popup_validity_time" value="<?=$popup_validity_time?>">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
  // $(function(){
  //   var is_popup = '<?=$is_popup?>';
  //   if(is_popup == 1) {
  //     $('.is-popup-yes').show();
  //     $('#popup_validity_date').attr('required', true);
  //     $('#popup_validity_time').attr('required', true);
  //   } else {
  //     $('.is-popup-yes').hide();
  //     $('#popup_validity_date').attr('required', false);
  //     $('#popup_validity_time').attr('required', false);
  //   }

  //   $('input[name="is_popup"]').click(function() {
  //      if($(this).val() == 1) {
  //         $('.is-popup-yes').show();
  //         $('#popup_validity_date').attr('required', true);
  //         $('#popup_validity_time').attr('required', true);
  //      } else {
  //         $('.is-popup-yes').hide();
  //         $('#popup_validity_date').attr('required', false);
  //         $('#popup_validity_time').attr('required', false);
  //      }
  //    });
  // })
</script>
@endsection