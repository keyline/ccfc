@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.reciprocalClub.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reciprocal-clubs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required"
                    for="reciprocal_club_name">{{ trans('cruds.reciprocalClub.fields.reciprocal_club_name') }}</label>
                <input class="form-control {{ $errors->has('reciprocal_club_name') ? 'is-invalid' : '' }}" type="text"
                    name="reciprocal_club_name" id="reciprocal_club_name" value="{{ old('reciprocal_club_name', '') }}"
                    required>
                @if($errors->has('reciprocal_club_name'))
                <span class="text-danger">{{ $errors->first('reciprocal_club_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reciprocalClub.fields.reciprocal_club_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_1">{{ trans('cruds.reciprocalClub.fields.address_1') }}</label>
                <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text"
                    name="address_1" id="address_1" value="{{ old('address_1', '') }}">
                @if($errors->has('address_1'))
                <span class="text-danger">{{ $errors->first('address_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reciprocalClub.fields.address_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_2">{{ trans('cruds.reciprocalClub.fields.address_2') }}</label>
                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text"
                    name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                @if($errors->has('address_2'))
                <span class="text-danger">{{ $errors->first('address_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reciprocalClub.fields.address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.reciprocalClub.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                    id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reciprocalClub.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.reciprocalClub.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                    id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reciprocalClub.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.reciprocalClub.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website"
                    id="website" value="{{ old('website', '') }}">
                @if($errors->has('website'))
                <span class="text-danger">{{ $errors->first('website') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reciprocalClub.fields.website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="details">{{ trans('cruds.reciprocalClub.fields.details') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('details') ? 'is-invalid' : '' }}" name="details"
                    id="details">{!! old('details') !!}</textarea>
                @if($errors->has('details'))
                <span class="text-danger">{{ $errors->first('details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reciprocalClub.fields.details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="club_image">{{ trans('cruds.reciprocalClub.fields.club_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('club_image') ? 'is-invalid' : '' }}"
                    id="club_image-dropzone">
                </div>
                @if($errors->has('club_image'))
                <span class="text-danger">{{ $errors->first('club_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reciprocalClub.fields.club_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.reciprocalClub.fields.cub_type') }}</label>
                @foreach(App\Models\ReciprocalClub::CUB_TYPE_RADIO as $key => $label)
                <div class="form-check {{ $errors->has('cub_type') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="cub_type_{{ $key }}" name="cub_type"
                        value="{{ $key }}" {{ old('cub_type', '') === (string) $key ? 'checked' : '' }} required>
                    <label class="form-check-label" for="cub_type_{{ $key }}">{{ $label }}</label>
                </div>
                @endforeach
                @if($errors->has('cub_type'))
                <span class="text-danger">{{ $errors->first('cub_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reciprocalClub.fields.cub_type_helper') }}</span>
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
$(document).ready(function() {
    function SimpleUploadAdapter(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
            return {
                upload: function() {
                    return loader.file
                        .then(function(file) {
                            return new Promise(function(resolve, reject) {
                                // Init request
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', '{{ route('admin.reciprocal-clubs.storeCKEditorImages') }}',
                                    true);
                                xhr.setRequestHeader('x-csrf-token', window._token);
                                xhr.setRequestHeader('Accept', 'application/json');
                                xhr.responseType = 'json';

                                // Init listeners
                                var genericErrorText =
                                    `Couldn't upload file: ${ file.name }.`;
                                xhr.addEventListener('error', function() {
                                    reject(genericErrorText)
                                });
                                xhr.addEventListener('abort', function() {
                                    reject()
                                });
                                xhr.addEventListener('load', function() {
                                    var response = xhr.response;

                                    if (!response || xhr.status !== 201) {
                                        return reject(response && response.message ?
                                            `${genericErrorText}\n${xhr.status} ${response.message}` :
                                            `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                            );
                                    }

                                    $('form').append(
                                        '<input type="hidden" name="ck-media[]" value="' +
                                        response.id + '">');

                                    resolve({
                                        default: response.url
                                    });
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
                                data.append('crud_id', '{{ $reciprocalClub->id ?? 0 }}');
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
Dropzone.options.clubImageDropzone = {
    url: '{{ route('admin.reciprocal-clubs.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
        size: 1,
        width: 4096,
        height: 4096
    },
    success: function(file, response) {
        $('form').find('input[name="club_image"]').remove()
        $('form').append('<input type="hidden" name="club_image" value="' + response.name + '">')
    },
    removedfile: function(file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="club_image"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
    },
    init: function() {
        @if(isset($reciprocalClub) && $reciprocalClub->club_image)
        var file = {
            !!json_encode($reciprocalClub->club_image) !!
        }
        this.options.addedfile.call(this, file)
        this.options.thumbnail.call(this, file, file.preview)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="club_image" value="' + file.file_name + '">')
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