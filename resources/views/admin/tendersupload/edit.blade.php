@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tenderupload.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.tenderuploads.update', [$document->ctd_id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="tender_title">{{ trans('cruds.tenderupload.fields.tender_title') }}</label>
                <input class="form-control {{ $errors->has('sport_name') ? 'is-invalid' : '' }}" type="text"
                    name="tender_title" id="tender_title" value="{{ old('tender_title', $document->ctd_title) }}" required>
                @if($errors->has('tender_title'))
                <span class="text-danger">{{ $errors->first('tender_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tenderupload.fields.tender_name_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="tender_description">{{ trans('cruds.tenderupload.fields.tender_description') }}</label>
                <input class="form-control {{ $errors->has('tender_description') ? 'is-invalid' : '' }}" type="text"
                    name="tender_description" id="tender_description" value="{{ old('tender_description', $document->ctd_description) }}" required>
                @if($errors->has('tender_description'))
                <span class="text-danger">{{ $errors->first('tender_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tenderupload.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon">{{ trans('cruds.tenderupload.fields.tender_files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('tender_files') ? 'is-invalid' : '' }}" id="document-dropzone">
                </div>
                @if($errors->has('tender_files'))
                <span class="text-danger">{{ $errors->first('tender_files') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tenderupload.fields.tender_files_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon">{{ trans('cruds.tenderupload.fields.tender_archive_status') }}</label>
                <input class="form-check-input" type="checkbox" name="tender_archive" value="{{ $document->ctd_archive_status }}" id="archiveStatusCheckbox" {{ ! $document->ctd_archive_status ? 'checked' : '' }}>
                @if($errors->has('tender_archive_status'))
                <span class="text-danger">{{ $errors->first('tender_archive_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tenderupload.fields.tender_archive_helper') }}</span>
  
            </div>
			
			
			
			
			
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: '{{route('admin.tenderuploads.storeMedia')}}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    acceptedFiles: '.pdf, .pdfs',
    maxFiles: 5,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="tender_files[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="tender_files[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($document))
        var thisDropzone = this;

            // Fetch existing files and add them to the Dropzone instance
            @foreach($document->getFiles() as $file)
                var mockFile = { name: "{{ $file->cfm_original_name }}", size: {{ $file->cfm_file_size }}, type: "{{ $file->cfm_mime_type }}" };
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "{{ $file->cfm_physical_path }}");
                mockFile.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="tender_files[]" value="' + "{{ $file->cfm_original_name }}" + '">')
            @endforeach
      @endif
    }
  }
</script>
@stop