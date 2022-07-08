@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
    </div>    
    <div class="card-body">
        <form>
            @csrf
            <div class="form-group">
                <label class="required" for="mail_subject">Type</label>
                <input class="form-control {{ $errors->has('mail_subject') ? 'is-invalid' : '' }}" type="text" name="ec_type" id="mail_subject" value="{{ old('mail_subject', $emailcampaign->ec_type) }}" required>
                @if($errors->has('mail_subject'))
                    <span class="text-danger">{{ $errors->first('mail_subject') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
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
            

            
            @if(isset($emailcampaign->ec_attachment) && trim($emailcampaign->ec_attachment) !== '')
            <div class="attachment">
            <span class="attached-file">{{asset('storage/campaign_attachments' . $emailcampaign->ec_attachment)}}</span>
            <span><button class="btn btn-danger rm-attachment" data-rmid="{{ $emailcampaign->ec_id }}" disabled>Remove Attachment</button></span>
            </div>
            @endif
            <!-- <button>Save as draft</button> -->
            <!-- <button>Send</button> -->
            <div class="form-group">
                <label>Member Type</label>
                <ul>
                    <?php
                    $ec_member_type = json_decode($emailcampaign->ec_member_type);
                    if(count($ec_member_type)>0){ for($emt=0;$emt<count($ec_member_type);$emt++){
                    ?>
                        <li><?=$ec_member_type[$emt]?></li>
                    <?php } }?>
                </ul>
            </div>
        </form>
        <button  onclick="location.href= '{{ route('admin.list-campaign')}}'" class="btn btn-success">Back To List</button>
        
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

  $(document).on('click', '.rm-attachment',function(e){
      e.preventDefault();
      var div_to_delete= $(this).closest('.attachment');

      var diplay_on= $(this).closest('div').prev();
  
      var rmId= $(this).data('rmid');
  
      var _token = $("input[name='_token']").val();

      if(!rmId){
          alert("Nothing to delete");
      }

      deleteAttachment(_token, rmId).then(function(result){
          if(result.status){
              
              $(diplay_on).delay(1000).css('display', '');
                $(div_to_delete).remove();
              
              

          }
          console.log(result.error);
      });
  });

});

function deleteAttachment(token, deleteforid){
    return $.ajax({
          url: "{{ route('admin.remove-attachment') }}",
          type: "POST",
          data: {"_token": token, "forid": deleteforid},
          cache: false,
          dataType: 'JSON'

      });


}
</script>
@endsection