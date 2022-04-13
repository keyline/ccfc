@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sportstype.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sportstypes.update", [$sportstype->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="sport_name">{{ trans('cruds.sportstype.fields.sport_name') }}</label>
                <input class="form-control {{ $errors->has('sport_name') ? 'is-invalid' : '' }}" type="text"
                    name="sport_name" id="sport_name" value="{{ old('sport_name', $sportstype->sport_name) }}" required>
                @if($errors->has('sport_name'))
                <span class="text-danger">{{ $errors->first('sport_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sportstype.fields.sport_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon">{{ trans('cruds.sportstype.fields.icon') }}</label>
                <div class="needsclick dropzone {{ $errors->has('icon') ? 'is-invalid' : '' }}" id="icon-dropzone">
                </div>
                @if($errors->has('icon'))
                <span class="text-danger">{{ $errors->first('icon') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sportstype.fields.icon_helper') }}</span>
            </div>
            <!-- <div class="form-group">
                <label for="featured_image">{{ trans('cruds.sportstype.fields.featured_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}"
                    id="featured_image-dropzone">
                </div>
                @if($errors->has('featured_image'))
                <span class="text-danger">{{ $errors->first('featured_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sportstype.fields.featured_image_helper') }}</span>
            </div> -->
			
			<div class="form-group">
                <label class="required" for="excerpt">{{ trans('cruds.sportstype.fields.excerpt') }}</label>
                <input class="form-control {{ $errors->has('sportstype') ? 'is-invalid' : '' }}" type="text"
                    name="sport_details" id="sportstype" value="{{ old('sportstype', $sportstype->sport_details) }}" required>
                @if($errors->has('excerpt'))
                <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sportstype.fields.sport_name_helper') }}</span>
            </div>
			
			<!--<div class="form-group">
                <label for="sport_details">{{ trans('cruds.sportstype.fields.sport_details') }}</label>
                <textarea class="form-control {{ $errors->has('sport_details') ? 'is-invalid' : '' }}" name="sport_details" id="sport_details">{{ old('sport_details', $errors->sport_details) }}</textarea>
                @if($errors->has('sport_details'))
                    <span class="text-danger">{{ $errors->first('sport_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sportstype.fields.sport_details_helper') }}</span>
            </div>-->
			
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
Dropzone.options.iconDropzone = {
    url: '{{ route('admin.sportstypes.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.svg',
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
    success: function(file, response) {
        $('form').find('input[name="icon"]').remove()
        $('form').append('<input type="hidden" name="icon" value="' + response.name + '">')
    },
    removedfile: function(file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="icon"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
    },
    init: function() {
        @if(isset($sportstype) && $sportstype->icon)
        var file = {!! json_encode($sportstype->icon) !!}
        this.options.addedfile.call(this, file)
        this.options.thumbnail.call(this, file, file.preview)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="icon" value="' + file.file_name + '">')
        this.options.maxFiles = this.options.maxFiles - 1
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
<script>
Dropzone.options.featuredImageDropzone = {
    url: '{{ route('admin.sportstypes.storeMedia') }}',
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
    success: function(file, response) {
        $('form').find('input[name="featured_image"]').remove()
        $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
    },
    removedfile: function(file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="featured_image"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
    },
    init: function() {
        @if(isset($sportstype) && $sportstype->featured_image)
        var file = {!!json_encode($sportstype->featured_image) !!}
        this.options.addedfile.call(this, file)
        this.options.thumbnail.call(this, file, file.preview)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
        this.options.maxFiles = this.options.maxFiles - 1
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