@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.gallery.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.galleries.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="gallery_name">{{ trans('cruds.gallery.fields.gallery_name') }}</label>
                <input class="form-control {{ $errors->has('gallery_name') ? 'is-invalid' : '' }}" type="text"
                    name="gallery_name" id="gallery_name" value="{{ old('gallery_name', '') }}" required>
                @if($errors->has('gallery_name'))
                <span class="text-danger">{{ $errors->first('gallery_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gallery.fields.gallery_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.gallery.fields.gallery_type') }}</label>
                <select class="form-control {{ $errors->has('gallery_type') ? 'is-invalid' : '' }}" name="gallery_type"
                    id="gallery_type" required>
                    <option value disabled {{ old('gallery_type', null) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Gallery::GALLERY_TYPE_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('gallery_type', 'Type 1') === (string) $key ? 'selected' : '' }}>
                        {{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gallery_type'))
                <span class="text-danger">{{ $errors->first('gallery_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gallery.fields.gallery_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="images">{{ trans('cruds.gallery.fields.images') }}</label>
                <div class="needsclick dropzone {{ $errors->has('images') ? 'is-invalid' : '' }}" id="images-dropzone">
                </div>
                @if($errors->has('images'))
                <span class="text-danger">{{ $errors->first('images') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gallery.fields.images_helper') }}</span>
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
var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('
    admin.galleries.storeMedia ') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
        size: 2,
        width: 4096,
        height: 4096
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
        uploadedImagesMap[file.name] = response.name
    },
    removedfile: function(file) {
        console.log(file)
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedImagesMap[file.name]
        }
        $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function() {
        @if(isset($gallery) && $gallery - > images)
        var files = {
            !!json_encode($gallery - > images) !!
        }
        for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
        }
        @endif
    },
    error: function(file, response) {
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