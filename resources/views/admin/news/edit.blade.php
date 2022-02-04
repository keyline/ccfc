@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.news.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.news.update", [$news->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="news_title">{{ trans('cruds.news.fields.news_title') }}</label>
                <input class="form-control {{ $errors->has('news_title') ? 'is-invalid' : '' }}" type="text" name="news_title" id="news_title" value="{{ old('news_title', $news->news_title) }}" required>
                @if($errors->has('news_title'))
                    <span class="text-danger">{{ $errors->first('news_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.news.fields.news_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="news_details">{{ trans('cruds.news.fields.news_details') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('news_details') ? 'is-invalid' : '' }}" name="news_details" id="news_details">{!! old('news_details', $news->news_details) !!}</textarea>
                @if($errors->has('news_details'))
                    <span class="text-danger">{{ $errors->first('news_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.news.fields.news_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="event_image">{{ trans('cruds.news.fields.event_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('event_image') ? 'is-invalid' : '' }}" id="event_image-dropzone">
                </div>
                @if($errors->has('event_image'))
                    <span class="text-danger">{{ $errors->first('event_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.news.fields.event_image_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.news.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $news->id ?? 0 }}');
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
    var uploadedEventImageMap = {}
Dropzone.options.eventImageDropzone = {
    url: '{{ route('admin.news.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="event_image[]" value="' + response.name + '">')
      uploadedEventImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedEventImageMap[file.name]
      }
      $('form').find('input[name="event_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($news) && $news->event_image)
      var files = {!! json_encode($news->event_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="event_image[]" value="' + file.file_name + '">')
        }
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