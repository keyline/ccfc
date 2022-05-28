@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.new-campaign") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">Type</label><br>

                <input type="radio" name="ec_type" id="ec_type1" value="Notice and Circulars Emails" required>
                <label class="required" for="ec_type1">Notice and Circulars Emails</label>

                <input type="radio" name="ec_type" id="ec_type2" value="Invoice Emails" required>
                <label class="required" for="ec_type2">Invoice Emails</label>

                @if($errors->has('ec_type'))
                    <span class="text-danger">{{ $errors->first('ec_type') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="mail_subject">Subject</label>
                <input class="form-control {{ $errors->has('mail_subject') ? 'is-invalid' : '' }}" type="text" name="ec_title" id="mail_subject" value="{{ old('mail_subject', '') }}" required>
                @if($errors->has('mail_subject'))
                    <span class="text-danger">{{ $errors->first('mail_subject') }}</span>
                @endif
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label for="mail_body">Body</label>
                <textarea class="form-control ckeditor {{ $errors->has('mail_body') ? 'is-invalid' : '' }}" name="ec_body" id="mail_body">{!! old('mail_body') !!}</textarea>
                @if($errors->has('mail_body'))
                    <span class="text-danger">{{ $errors->first('mail_body') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <input type="hidden" name="ec_is_despatched" value='1'>
            <div class="form-group">

            <div class="form-group">
                <label for="attachment" class="form-label">Attachment</label>
            
            <input class="form-control" type="file" id="attachment" name="file">
            
            </div>
            <!-- <button>Save as draft</button> -->
            <!-- <button>Send</button> -->
            <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover">
                <thead>
                    <tr>                        
                        <th>NO.</th>
                        <th>Date Created</th>
                        <th>Type</th>
                        <th>Subject</th>
                        <th>Sent On</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Send</th>
                        <!-- <th>&nbsp;</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns AS $campaign)
                        <tr data-entry-id="{{ $campaign->ec_id }}">
                            <td>{{ $campaign->ec_id }}</td>
                            <td>{{ date_format(date_create($campaign->created_at), "d-m-Y h:i A") }}</td>
                            <td>{{ $campaign->ec_type }}</td>
                            <td>{{ $campaign->ec_title }}</td>
                            <td>
                                {{ ($campaign->ec_is_despatched == '0') ? $campaign->updated_at : ''}}
                            </td>
                            <td>
                               <button class="btn btn-info" onclick="location.href='{{ route('admin.show-campaign', $campaign->ec_id) }}'">{{ trans('global.show') }}</button>
                            </td>
                            <td>
                                <button class="btn btn-info" onclick="location.href='{{ route('admin.edit-campaign', $campaign->ec_id) }}'" {{ ($campaign->ec_is_despatched == '0') ? 'disabled' : ''}}>{{ trans('global.edit') }}</button>
                            </td>
                            <td><button class="btn btn-info" onclick="location.href='{{ route('admin.start-campaign', ['campaign'=> $campaign->ec_id])}}'" {{ ($campaign->ec_is_despatched == '0') ? 'disabled' : ''}}>Send</button></td>
                            <!-- <td></td> -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $campaigns->links() !!}
        </div>
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