@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_code_id">{{ trans('cruds.userDetail.fields.user_code') }}</label>
                <select class="form-control select2 {{ $errors->has('user_code') ? 'is-invalid' : '' }}" name="user_code_id" id="user_code_id">
                    @foreach($user_codes as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_code_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_code'))
                    <span class="text-danger">{{ $errors->first('user_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.user_code_helper') }}</span>
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