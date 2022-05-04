@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
    </div>
    
    <div class="card-body">
        <form method="POST" action="{{ route("admin.update-campaign", [$emailcampaign->ec_id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="mail_subject">Subject</label>
                <input class="form-control {{ $errors->has('mail_subject') ? 'is-invalid' : '' }}" type="text" name="ec_title" id="mail_subject" value="{{ old('mail_subject', $emailcampaign->ec_title) }}" required>
                @if($errors->has('mail_subject'))
                    <span class="text-danger">{{ $errors->first('mail_subject') }}</span>
                @endif
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label for="mail_body">Body</label>
                <textarea class="form-control ckeditor {{ $errors->has('mail_body') ? 'is-invalid' : '' }}" name="ec_body" id="mail_body">{!! old('mail_body', $emailcampaign->ec_body) !!}</textarea>
                @if($errors->has('mail_body'))
                    <span class="text-danger">{{ $errors->first('mail_body') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <input type="hidden" name="ec_is_despatched" value='1'>
            <div class="form-group">

            <div class="form-group">
                <label for="attachment" class="form-label">Attachment</label>
            
            <input class="form-control" type="file" id="attachment" name="file" value="">
            
            </div>
            <!-- <button>Save as draft</button> -->
            <!-- <button>Send</button> -->
            <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>

        
    </div>

</div>



@endsection
@section('scripts')
@parent
<script>
$(function() {
    var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        //extraPlugins: [SimpleUploadAdapter]
      }
    );
  }

});
</script>
@endsection