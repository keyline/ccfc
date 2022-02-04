@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pastPresident.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.past-presidents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.pastPresident.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pastPresident.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="duration">{{ trans('cruds.pastPresident.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="text" name="duration" id="duration" value="{{ old('duration', '') }}">
                @if($errors->has('duration'))
                    <span class="text-danger">{{ $errors->first('duration') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pastPresident.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="short_order">{{ trans('cruds.pastPresident.fields.short_order') }}</label>
                <input class="form-control {{ $errors->has('short_order') ? 'is-invalid' : '' }}" type="number" name="short_order" id="short_order" value="{{ old('short_order', '') }}" step="1">
                @if($errors->has('short_order'))
                    <span class="text-danger">{{ $errors->first('short_order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pastPresident.fields.short_order_helper') }}</span>
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