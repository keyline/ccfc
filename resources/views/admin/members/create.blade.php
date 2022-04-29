@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.member.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.members.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <!-- <label class="required" for="select_member_id">{{ trans('cruds.member.fields.select_member') }}</label> -->
                <label class="required" for="select_member_id">Select Member Code</label>
                <select class="form-control select2 {{ $errors->has('select_member') ? 'is-invalid' : '' }}"
                    name="select_member_id" id="select_member_id" required>
                    @foreach($select_members as $id => $entry)
                    <option value="{{ $id }}" {{ old('select_member_id') == $id ? 'selected' : '' }}>{{ $entry }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('select_member'))
                <span class="text-danger">{{ $errors->first('select_member') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.select_member_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="select_title_id">{{ trans('cruds.member.fields.select_title') }}</label>
                <select class="form-control select2 {{ $errors->has('select_title') ? 'is-invalid' : '' }}"
                    name="select_title_id" id="select_title_id" required>
                    @foreach($select_titles as $id => $entry)
                    <option value="{{ $id }}" {{ old('select_title_id') == $id ? 'selected' : '' }}>{{ $entry }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('select_title'))
                <span class="text-danger">{{ $errors->first('select_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.select_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="select_sport_id">{{ trans('cruds.member.fields.select_sport') }}</label>
                <select class="form-control select2 {{ $errors->has('select_sport') ? 'is-invalid' : '' }}"
                    name="select_sport_id" id="select_sport_id" required>
                    @foreach($select_sports as $id => $entry)
                    <option value="{{ $id }}" {{ old('select_sport_id') == $id ? 'selected' : '' }}>{{ $entry }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('select_sport'))
                <span class="text-danger">{{ $errors->first('select_sport') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.select_sport_helper') }}</span>
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