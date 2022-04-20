@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.new-campaign") }}" enctype="multipart/form-data">
            @csrf
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
            <button>Save as draft</button>
            <button>Send</button>
            <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SendInBlueMails">
                <thead>
                    <tr>
                        
                        <th>
                            NO.
                        </th>
                        <th>
                            Date Created
                        </th>
                        <th>
                            Subject
                        </th>
                        <th>
                            Sent On
                        </th>
                        <th>
                            Total Receipient
                        </th>
                        <th>
                            View
                        </th>
                        <th>
                            Send
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns AS $campaign)
                        <tr data-entry-id="{{ $campaign->ec_id }}">
                            <td>{{ $campaign->ec_id }}</td>
                            <td>{{ $campaign->created_at }}</td>
                            <td>{{ $campaign->ec_title }}</td>
                            <td>
                                
                            </td>
                            <td>
                               
                            </td>
                            <td>

                            </td>

                            <td></td>
                            <td><button class="btn btn-info" onclick="location.href='{{ route('admin.start-campaign', ['campaign'=> $campaign->ec_id])}}'">Send</button></td>

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

  //DataTable
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-SendInBlueMails:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});
</script>
@endsection