@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
    </div>    
    <div class="card-body">
        <form method="POST" action="{{ route("admin.update-campaign", [$emailcampaign->ec_id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">Type</label><br>

                <input type="radio" name="ec_type" id="ec_type1" value="Notice and Circulars Emails" required <?=(($emailcampaign->ec_type == 'Notice and Circulars Emails')?'checked':'')?>>
                <label class="required" for="ec_type1">Notice and Circulars Emails</label>

                <input type="radio" name="ec_type" id="ec_type2" value="Invoice Emails" required <?=(($emailcampaign->ec_type == 'Invoice Emails')?'checked':'')?>>
                <label class="required" for="ec_type2">Invoice Emails</label>

                @if($errors->has('ec_type'))
                    <span class="text-danger">{{ $errors->first('ec_type') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required">Member Type</label><br>
                <div class="row">
                    <div class="col-md-4">
                        <input type="checkbox" id="checkAll">
                        <label for="checkAll">Check All</label>
                    </div>
                    <?php if($memberTypes){ $i=1;foreach($memberTypes as $memberType){?>
                    <?php $ec_member_type = json_decode($emailcampaign->ec_member_type); ?>
                    <div class="col-md-4">
                        <input type="checkbox" name="ec_member_type[]" id="ec_member_type<?=$i?>" value="<?=$memberType->member_type?>" <?=((in_array($memberType->member_type, $ec_member_type))?'checked':'')?>>
                        <label for="ec_member_type<?=$i?>" style="font-weight: normal;"><?=$memberType->member_type?></label>
                    </div>
                    <?php $i++;} }?>
                </div>
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
            

            <div class="form-group" {{ (isset($emailcampaign->ec_attachment) && trim($emailcampaign->ec_attachment) !== '') ? 'style=display:none;' : ''}}>
                <label for="attachment" class="form-label">Attachment</label>
            
            <input class="form-control" type="file" id="attachment" name="file" value="">
            
            </div>
            @if(isset($emailcampaign->ec_attachment) && trim($emailcampaign->ec_attachment) !== '')
            <div class="attachment">
            <span class="attached-file">{{asset('storage/campaign_attachments' . $emailcampaign->ec_attachment)}}</span>
            <span><button class="btn btn-danger rm-attachment" data-rmid="{{ $emailcampaign->ec_id }}">Remove Attachment</button></span>
            </div>
            @endif
            <!-- <button>Save as draft</button> -->
            <!-- <button>Send</button> -->
            <div class="form-group">
            <button type="submit" class="btn btn-success" id="checkBtn">Save</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $('#checkBtn').click(function() {
            checked = $("input[type=checkbox]:checked").length;
            if(!checked) {
                alert("You Must Select At Least One Member Type !!!");
                return false;
            }
        });
    });
</script>
@endsection