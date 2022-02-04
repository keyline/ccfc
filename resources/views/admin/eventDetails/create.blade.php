@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.eventDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.event-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="event_title">{{ trans('cruds.eventDetail.fields.event_title') }}</label>
                <input class="form-control {{ $errors->has('event_title') ? 'is-invalid' : '' }}" type="text" name="event_title" id="event_title" value="{{ old('event_title', '') }}" required>
                @if($errors->has('event_title'))
                    <span class="text-danger">{{ $errors->first('event_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventDetail.fields.event_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="event_details">{{ trans('cruds.eventDetail.fields.event_details') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('event_details') ? 'is-invalid' : '' }}" name="event_details" id="event_details">{!! old('event_details') !!}</textarea>
                @if($errors->has('event_details'))
                    <span class="text-danger">{{ $errors->first('event_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventDetail.fields.event_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="event_image">{{ trans('cruds.eventDetail.fields.event_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('event_image') ? 'is-invalid' : '' }}" id="event_image-dropzone">
                </div>
                @if($errors->has('event_image'))
                    <span class="text-danger">{{ $errors->first('event_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventDetail.fields.event_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_date">{{ trans('cruds.eventDetail.fields.event_date') }}</label>
                <input class="form-control date {{ $errors->has('event_date') ? 'is-invalid' : '' }}" type="text" name="event_date" id="event_date" value="{{ old('event_date') }}" required>
                @if($errors->has('event_date'))
                    <span class="text-danger">{{ $errors->first('event_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventDetail.fields.event_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gallery_id">{{ trans('cruds.eventDetail.fields.gallery') }}</label>
                <select class="form-control select2 {{ $errors->has('gallery') ? 'is-invalid' : '' }}" name="gallery_id" id="gallery_id">
                    @foreach($galleries as $id => $entry)
                        <option value="{{ $id }}" {{ old('gallery_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('gallery'))
                    <span class="text-danger">{{ $errors->first('gallery') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventDetail.fields.gallery_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.event-details.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $eventDetail->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.eventImageDropzone = {
    url: '{{ route('admin.event-details.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 2000,
      height: 1600
    },
    success: function (file, response) {
      $('form').find('input[name="event_image"]').remove()
      $('form').append('<input type="hidden" name="event_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="event_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($eventDetail) && $eventDetail->event_image)
      var file = {!! json_encode($eventDetail->event_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="event_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection