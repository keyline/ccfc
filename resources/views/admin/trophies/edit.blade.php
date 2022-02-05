@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.trophy.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trophies.update", [$trophy->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="trophy">{{ trans('cruds.trophy.fields.trophy') }}</label>
                <input class="form-control {{ $errors->has('trophy') ? 'is-invalid' : '' }}" type="text" name="trophy" id="trophy" value="{{ old('trophy', $trophy->trophy) }}" required>
                @if($errors->has('trophy'))
                    <span class="text-danger">{{ $errors->first('trophy') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trophy.fields.trophy_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="trophy_description">{{ trans('cruds.trophy.fields.trophy_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('trophy_description') ? 'is-invalid' : '' }}" name="trophy_description" id="trophy_description">{!! old('trophy_description', $trophy->trophy_description) !!}</textarea>
                @if($errors->has('trophy_description'))
                    <span class="text-danger">{{ $errors->first('trophy_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trophy.fields.trophy_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="trophy_photo">{{ trans('cruds.trophy.fields.trophy_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('trophy_photo') ? 'is-invalid' : '' }}" id="trophy_photo-dropzone">
                </div>
                @if($errors->has('trophy_photo'))
                    <span class="text-danger">{{ $errors->first('trophy_photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trophy.fields.trophy_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="year_of_award">{{ trans('cruds.trophy.fields.year_of_award') }}</label>
                <input class="form-control {{ $errors->has('year_of_award') ? 'is-invalid' : '' }}" type="text" name="year_of_award" id="year_of_award" value="{{ old('year_of_award', $trophy->year_of_award) }}">
                @if($errors->has('year_of_award'))
                    <span class="text-danger">{{ $errors->first('year_of_award') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trophy.fields.year_of_award_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.trophies.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $trophy->id ?? 0 }}');
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
    Dropzone.options.trophyPhotoDropzone = {
    url: '{{ route('admin.trophies.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="trophy_photo"]').remove()
      $('form').append('<input type="hidden" name="trophy_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="trophy_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($trophy) && $trophy->trophy_photo)
      var file = {!! json_encode($trophy->trophy_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="trophy_photo" value="' + file.file_name + '">')
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