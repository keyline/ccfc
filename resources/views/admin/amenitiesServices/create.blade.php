@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.amenitiesService.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.amenities-services.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="amenity_name">{{ trans('cruds.amenitiesService.fields.amenity_name') }}</label>
                <input class="form-control {{ $errors->has('amenity_name') ? 'is-invalid' : '' }}" type="text" name="amenity_name" id="amenity_name" value="{{ old('amenity_name', '') }}" required>
                @if($errors->has('amenity_name'))
                    <span class="text-danger">{{ $errors->first('amenity_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenitiesService.fields.amenity_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amenity_details">{{ trans('cruds.amenitiesService.fields.amenity_details') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('amenity_details') ? 'is-invalid' : '' }}" name="amenity_details" id="amenity_details">{!! old('amenity_details') !!}</textarea>
                @if($errors->has('amenity_details'))
                    <span class="text-danger">{{ $errors->first('amenity_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenitiesService.fields.amenity_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image_gallery_id">{{ trans('cruds.amenitiesService.fields.image_gallery') }}</label>
                <select class="form-control select2 {{ $errors->has('image_gallery') ? 'is-invalid' : '' }}" name="image_gallery_id" id="image_gallery_id">
                    @foreach($image_galleries as $id => $entry)
                        <option value="{{ $id }}" {{ old('image_gallery_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('image_gallery'))
                    <span class="text-danger">{{ $errors->first('image_gallery') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenitiesService.fields.image_gallery_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.amenities-services.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $amenitiesService->id ?? 0 }}');
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

@endsection