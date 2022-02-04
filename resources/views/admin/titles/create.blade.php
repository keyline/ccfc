@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.title.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.titles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="titles">{{ trans('cruds.title.fields.titles') }}</label>
                <input class="form-control {{ $errors->has('titles') ? 'is-invalid' : '' }}" type="text" name="titles" id="titles" value="{{ old('titles', '') }}" required>
                @if($errors->has('titles'))
                    <span class="text-danger">{{ $errors->first('titles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.title.fields.titles_helper') }}</span>
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