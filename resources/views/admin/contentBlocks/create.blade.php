<<<<<<< HEAD
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contentBlock.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.content-blocks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name_of_the_block">{{ trans('cruds.contentBlock.fields.name_of_the_block') }}</label>
                <input class="form-control {{ $errors->has('name_of_the_block') ? 'is-invalid' : '' }}" type="text" name="name_of_the_block" id="name_of_the_block" value="{{ old('name_of_the_block', '') }}">
                @if($errors->has('name_of_the_block'))
                    <span class="text-danger">{{ $errors->first('name_of_the_block') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.name_of_the_block_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="heading">{{ trans('cruds.contentBlock.fields.heading') }}</label>
                <input class="form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}" type="text" name="heading" id="heading" value="{{ old('heading', '') }}">
                @if($errors->has('heading'))
                    <span class="text-danger">{{ $errors->first('heading') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.heading_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="body">{{ trans('cruds.contentBlock.fields.body') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body">{!! old('body') !!}</textarea>
                @if($errors->has('body'))
                    <span class="text-danger">{{ $errors->first('body') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.body_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.contentBlock.fields.status') }}</label>
                @foreach(App\Models\ContentBlock::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="source_page_id">{{ trans('cruds.contentBlock.fields.source_page') }}</label>
                <select class="form-control select2 {{ $errors->has('source_page') ? 'is-invalid' : '' }}" name="source_page_id" id="source_page_id">
                    @foreach($source_pages as $id => $entry)
                        <option value="{{ $id }}" {{ old('source_page_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('source_page'))
                    <span class="text-danger">{{ $errors->first('source_page') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.source_page_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.content-blocks.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $contentBlock->id ?? 0 }}');
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
||||||| 135ffd0
=======
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contentBlock.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.content-blocks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name_of_the_block">{{ trans('cruds.contentBlock.fields.name_of_the_block') }}</label>
                <input class="form-control {{ $errors->has('name_of_the_block') ? 'is-invalid' : '' }}" type="text"
                    name="name_of_the_block" id="name_of_the_block" value="{{ old('name_of_the_block', '') }}">
                @if($errors->has('name_of_the_block'))
                <span class="text-danger">{{ $errors->first('name_of_the_block') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.name_of_the_block_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="heading">{{ trans('cruds.contentBlock.fields.heading') }}</label>
                <input class="form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}" type="text" name="heading"
                    id="heading" value="{{ old('heading', '') }}">
                @if($errors->has('heading'))
                <span class="text-danger">{{ $errors->first('heading') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.heading_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="body">{{ trans('cruds.contentBlock.fields.body') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body"
                    id="body">{!! old('body') !!}</textarea>
                @if($errors->has('body'))
                <span class="text-danger">{{ $errors->first('body') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.body_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.contentBlock.fields.status') }}</label>
                @foreach(App\Models\ContentBlock::STATUS_RADIO as $key => $label)
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}"
                        {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                </div>
                @endforeach
                @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="source_page_id">{{ trans('cruds.contentBlock.fields.source_page') }}</label>
                <select class="form-control select2 {{ $errors->has('source_page') ? 'is-invalid' : '' }}"
                    name="source_page_id" id="source_page_id">
                    @foreach($source_pages as $id => $entry)
                    <option value="{{ $id }}" {{ old('source_page_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('source_page'))
                <span class="text-danger">{{ $errors->first('source_page') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentBlock.fields.source_page_helper') }}</span>
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
                                xhr.open('POST', '{{ route('admin.content-blocks.storeCKEditorImages') }}',
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
                                data.append('crud_id', '{{ $contentBlock->id ?? 0 }}');
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
>>>>>>> 4a15c389e429dee1015c6ea9591579fe7dada072
