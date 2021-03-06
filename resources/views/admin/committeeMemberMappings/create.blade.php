@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.committeeMemberMapping.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.committee-member-mappings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required"
                    for="committee_id">{{ trans('cruds.committeeMemberMapping.fields.committee') }}</label>
                <select class="form-control select2 {{ $errors->has('committee') ? 'is-invalid' : '' }}"
                    name="committee_id" id="committee_id" required>
                    @foreach($committees as $id => $entry)
                    <option value="{{ $id }}" {{ old('committee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('committee'))
                <span class="text-danger">{{ $errors->first('committee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.committeeMemberMapping.fields.committee_helper') }}</span>
            </div>
            <div class="form-group">
                <!-- <label class="required"
                    for="member_id">{{ trans('cruds.committeeMemberMapping.fields.member') }}</label> -->
                <label class="required" for="member_id">Member code</label>
                <select class="form-control select2 {{ $errors->has('member') ? 'is-invalid' : '' }}" name="member_id"
                    id="member_id" required>
                    @foreach($members as $id => $entry)
                    <option value="{{ $id }}" {{ old('member_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('member'))
                <span class="text-danger">{{ $errors->first('member') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.committeeMemberMapping.fields.member_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required"
                    for="designation">{{ trans('cruds.committeeMemberMapping.fields.designation') }}</label>
                <input class="form-control {{ $errors->has('designation') ? 'is-invalid' : '' }}" type="text"
                    name="designation" id="designation" value="{{ old('designation', '') }}" required>
                @if($errors->has('designation'))
                <span class="text-danger">{{ $errors->first('designation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.committeeMemberMapping.fields.designation_helper') }}</span>
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