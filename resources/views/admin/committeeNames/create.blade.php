@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.committeeName.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.committee-names.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="committee_name_master">{{ trans('cruds.committeeName.fields.committee_name_master') }}</label>
                <input class="form-control {{ $errors->has('committee_name_master') ? 'is-invalid' : '' }}" type="text" name="committee_name_master" id="committee_name_master" value="{{ old('committee_name_master', '') }}" required>
                @if($errors->has('committee_name_master'))
                    <span class="text-danger">{{ $errors->first('committee_name_master') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.committeeName.fields.committee_name_master_helper') }}</span>
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