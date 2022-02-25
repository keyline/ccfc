@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.subCommitteeMember.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sub-committee-members.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="comittee_name_id">{{ trans('cruds.subCommitteeMember.fields.comittee_name') }}</label>
                <select class="form-control select2 {{ $errors->has('comittee_name') ? 'is-invalid' : '' }}" name="comittee_name_id" id="comittee_name_id" required>
                    @foreach($comittee_names as $id => $entry)
                        <option value="{{ $id }}" {{ old('comittee_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('comittee_name'))
                    <span class="text-danger">{{ $errors->first('comittee_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subCommitteeMember.fields.comittee_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="member_id">{{ trans('cruds.subCommitteeMember.fields.member') }}</label>
                <select class="form-control select2 {{ $errors->has('member') ? 'is-invalid' : '' }}" name="member_id" id="member_id">
                    @foreach($members as $id => $entry)
                        <option value="{{ $id }}" {{ old('member_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('member'))
                    <span class="text-danger">{{ $errors->first('member') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subCommitteeMember.fields.member_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('head_of_the_committee') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="head_of_the_committee" value="0">
                    <input class="form-check-input" type="checkbox" name="head_of_the_committee" id="head_of_the_committee" value="1" {{ old('head_of_the_committee', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="head_of_the_committee">{{ trans('cruds.subCommitteeMember.fields.head_of_the_committee') }}</label>
                </div>
                @if($errors->has('head_of_the_committee'))
                    <span class="text-danger">{{ $errors->first('head_of_the_committee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subCommitteeMember.fields.head_of_the_committee_helper') }}</span>
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