@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userDetail.title_singular') }}
    </div>
    <pre><code>{{ json_encode($userProfile, JSON_PRETTY_PRINT) }}</code></pre>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-details.update", [$userDetail->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_code_id">{{ trans('cruds.userDetail.fields.user_code') }}</label>
                <select class="form-control select2 {{ $errors->has('user_code') ? 'is-invalid' : '' }}"
                    name="user_code_id" id="user_code_id" required>
                    @foreach($user_codes as $id => $entry)
                    <option value="{{ $id }}"
                        {{ (old('user_code_id') ? old('user_code_id') : $userDetail->user_code->id ?? '') == $id ? 'selected' : '' }}>
                        {{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_code'))
                <span class="text-danger">{{ $errors->first('user_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.user_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required"
                    for="member_type_code">{{ trans('cruds.userDetail.fields.member_type_code') }}</label>
                <input class="form-control {{ $errors->has('member_type_code') ? 'is-invalid' : '' }}" type="text"
                    name="member_type_code" id="member_type_code" value="{{$userProfile['MEMBERTYPECODE'] }}" required>
                @if($errors->has('member_type_code'))
                <span class="text-danger">{{ $errors->first('member_type_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.member_type_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="member_type">{{ trans('cruds.userDetail.fields.member_type') }}</label>
                <input class="form-control {{ $errors->has('member_type') ? 'is-invalid' : '' }}" type="text"
                    name="member_type" id="member_type" value="{{ $userProfile['MEMBERTYPE'] }}">
                @if($errors->has('member_type'))
                <span class="text-danger">{{ $errors->first('member_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.member_type_helper') }}</span>
            </div>




            <div class="form-group">
                <label for="date_of_birth">{{ trans('cruds.userDetail.fields.date_of_birth') }}</label>
                <input class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text"
                    name="date_of_birth" id="date_of_birth" value="{{$userProfile['DOB'] }}">
                @if($errors->has('date_of_birth'))
                <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.date_of_birth_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="member_since">{{ trans('cruds.userDetail.fields.member_since') }}</label>
                <input class="form-control {{ $errors->has('member_since') ? 'is-invalid' : '' }}" type="text"
                    name="member_since" id="member_since" value="{{$userProfile['MEMBER_SINCE'] }}">
                @if($errors->has('member_since'))
                <span class="text-danger">{{ $errors->first('member_since') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.member_since_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">SEX</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="sex"
                    id="name" value="{{$userProfile['SEX'] }}">
            </div>

            <div class="form-group">
                <label for="address_1">{{ trans('cruds.userDetail.fields.address_1') }}</label>
                <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text"
                    name="address_1" id="address_1" value="{{$userProfile['ADDRESS1'] }}">
                @if($errors->has('address_1'))
                <span class="text-danger">{{ $errors->first('address_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.address_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_2">{{ trans('cruds.userDetail.fields.address_2') }}</label>
                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text"
                    name="address_2" id="address_2" value="{{$userProfile['ADDRESS2'] }}">
                @if($errors->has('address_2'))
                <span class="text-danger">{{ $errors->first('address_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_3">{{ trans('cruds.userDetail.fields.address_3') }}</label>
                <input class="form-control {{ $errors->has('address_3') ? 'is-invalid' : '' }}" type="text"
                    name="address_3" id="address_3" value="{{$userProfile['ADDRESS3'] }}">
                @if($errors->has('address_3'))
                <span class="text-danger">{{ $errors->first('address_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.address_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.userDetail.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city"
                    id="city" value="{{$userProfile['CITY'] }}">
                @if($errors->has('city'))
                <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state">{{ trans('cruds.userDetail.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state"
                    id="state" value="{{$userProfile['STATE'] }}">
                @if($errors->has('state'))
                <span class="text-danger">{{ $errors->first('state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pin">{{ trans('cruds.userDetail.fields.pin') }}</label>
                <input class="form-control {{ $errors->has('pin') ? 'is-invalid' : '' }}" type="text" name="pin"
                    id="pin" value="{{$userProfile['PIN'] }}">
                @if($errors->has('pin'))
                <span class="text-danger">{{ $errors->first('pin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.pin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_1">{{ trans('cruds.userDetail.fields.phone_1') }}</label>
                <input class="form-control {{ $errors->has('phone_1') ? 'is-invalid' : '' }}" type="text" name="phone_1"
                    id="phone_1" value="{{$userProfile['PHONE1'] }}">
                @if($errors->has('phone_1'))
                <span class="text-danger">{{ $errors->first('phone_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.phone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_2">{{ trans('cruds.userDetail.fields.phone_2') }}</label>
                <input class="form-control {{ $errors->has('phone_2') ? 'is-invalid' : '' }}" type="text" name="phone_2"
                    id="phone_2" value="{{$userProfile['PHONE2'] }}">
                @if($errors->has('phone_2'))
                <span class="text-danger">{{ $errors->first('phone_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile_no">{{ trans('cruds.userDetail.fields.mobile_no') }}</label>
                <input class="form-control {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" type="text"
                    name="mobile_no" id="mobile_no" value="{{$userProfile['MOBILENO'] }}">
                @if($errors->has('mobile_no'))
                <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.mobile_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.userDetail.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                    id="email" value="{{$userProfile['BUSINESS_EMAIL'] }}">
                @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="current_status">{{ trans('cruds.userDetail.fields.current_status') }}</label>
                <input class="form-control {{ $errors->has('current_status') ? 'is-invalid' : '' }}" type="text"
                    name="current_status" id="current_status" value="{{$userProfile['CURENTSTATUS'] }}">
                @if($errors->has('current_status'))
                <span class="text-danger">{{ $errors->first('current_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.current_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="represented_club_in">{{ trans('cruds.userDetail.fields.represented_club_in') }}</label>
                <input class="form-control {{ $errors->has('represented_club_in') ? 'is-invalid' : '' }}" type="text"
                    name="represented_club_in" id="represented_club_in"
                    value="{{ $userProfile['REPRESENTED_CLUB_IN'] }}">
                @if($errors->has('represented_club_in'))
                <span class="text-danger">{{ $errors->first('represented_club_in') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.represented_club_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hobbies_interest">{{ trans('cruds.userDetail.fields.hobbies_interest') }}</label>
                <input class="form-control {{ $errors->has('hobbies_interest') ? 'is-invalid' : '' }}" type="text"
                    name="hobbies_interest" id="hobbies_interest"
                    value="{{ old('hobbies_interest', $userDetail->hobbies_interest) }}">
                @if($errors->has('hobbies_interest'))
                <span class="text-danger">{{ $errors->first('hobbies_interest') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.hobbies_interest_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_profession">{{ trans('cruds.userDetail.fields.business_profession') }}</label>
                <input class="form-control {{ $errors->has('business_profession') ? 'is-invalid' : '' }}" type="text"
                    name="business_profession" id="business_profession"
                    value="{{ old('business_profession', $userDetail->business_profession) }}">
                @if($errors->has('business_profession'))
                <span class="text-danger">{{ $errors->first('business_profession') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_profession_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="category">{{ trans('cruds.userDetail.fields.category') }}</label>
                <input class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" type="text"
                    name="category" id="category" value="{{ old('category', $userDetail->category) }}">
                @if($errors->has('category'))
                <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_address_1">{{ trans('cruds.userDetail.fields.business_address_1') }}</label>
                <input class="form-control {{ $errors->has('business_address_1') ? 'is-invalid' : '' }}" type="text"
                    name="business_address_1" id="business_address_1"
                    value="{{ old('business_address_1', $userDetail->business_address_1) }}">
                @if($errors->has('business_address_1'))
                <span class="text-danger">{{ $errors->first('business_address_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_address_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_address_2">{{ trans('cruds.userDetail.fields.business_address_2') }}</label>
                <input class="form-control {{ $errors->has('business_address_2') ? 'is-invalid' : '' }}" type="text"
                    name="business_address_2" id="business_address_2"
                    value="{{ old('business_address_2', $userDetail->business_address_2) }}">
                @if($errors->has('business_address_2'))
                <span class="text-danger">{{ $errors->first('business_address_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_address_3">{{ trans('cruds.userDetail.fields.business_address_3') }}</label>
                <input class="form-control {{ $errors->has('business_address_3') ? 'is-invalid' : '' }}" type="text"
                    name="business_address_3" id="business_address_3"
                    value="{{ old('business_address_3', $userDetail->business_address_3) }}">
                @if($errors->has('business_address_3'))
                <span class="text-danger">{{ $errors->first('business_address_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_address_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_city">{{ trans('cruds.userDetail.fields.business_city') }}</label>
                <input class="form-control {{ $errors->has('business_city') ? 'is-invalid' : '' }}" type="text"
                    name="business_city" id="business_city"
                    value="{{ old('business_city', $userDetail->business_city) }}">
                @if($errors->has('business_city'))
                <span class="text-danger">{{ $errors->first('business_city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_state">{{ trans('cruds.userDetail.fields.business_state') }}</label>
                <input class="form-control {{ $errors->has('business_state') ? 'is-invalid' : '' }}" type="text"
                    name="business_state" id="business_state"
                    value="{{ old('business_state', $userDetail->business_state) }}">
                @if($errors->has('business_state'))
                <span class="text-danger">{{ $errors->first('business_state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_pin">{{ trans('cruds.userDetail.fields.business_pin') }}</label>
                <input class="form-control {{ $errors->has('business_pin') ? 'is-invalid' : '' }}" type="text"
                    name="business_pin" id="business_pin" value="{{ old('business_pin', $userDetail->business_pin) }}">
                @if($errors->has('business_pin'))
                <span class="text-danger">{{ $errors->first('business_pin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_pin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_phone_1">{{ trans('cruds.userDetail.fields.business_phone_1') }}</label>
                <input class="form-control {{ $errors->has('business_phone_1') ? 'is-invalid' : '' }}" type="text"
                    name="business_phone_1" id="business_phone_1"
                    value="{{ old('business_phone_1', $userDetail->business_phone_1) }}">
                @if($errors->has('business_phone_1'))
                <span class="text-danger">{{ $errors->first('business_phone_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_phone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_phone_2">{{ trans('cruds.userDetail.fields.business_phone_2') }}</label>
                <input class="form-control {{ $errors->has('business_phone_2') ? 'is-invalid' : '' }}" type="text"
                    name="business_phone_2" id="business_phone_2"
                    value="{{ old('business_phone_2', $userDetail->business_phone_2) }}">
                @if($errors->has('business_phone_2'))
                <span class="text-danger">{{ $errors->first('business_phone_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_email">{{ trans('cruds.userDetail.fields.business_email') }}</label>
                <input class="form-control {{ $errors->has('business_email') ? 'is-invalid' : '' }}" type="text"
                    name="business_email" id="business_email" value="{{ $userProfile['BUSINESS_EMAIL'] }}">
                @if($errors->has('business_email'))
                <span class="text-danger">{{ $errors->first('business_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.business_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_name">{{ trans('cruds.userDetail.fields.spouse_name') }}</label>
                <input class="form-control {{ $errors->has('spouse_name') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_name" id="spouse_name" value="{{ $userProfile['SPOUSE_NAME'] }}">
                @if($errors->has('spouse_name'))
                <span class="text-danger">{{ $errors->first('spouse_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_dob">{{ trans('cruds.userDetail.fields.spouse_dob') }}</label>
                <input class="form-control date {{ $errors->has('spouse_dob') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_dob" id="spouse_dob" value="{{ $userProfile['SPOUSE_DOB'] }}">
                @if($errors->has('spouse_dob'))
                <span class="text-danger">{{ $errors->first('spouse_dob') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_dob_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.userDetail.fields.spouse_sex') }}</label>
                @foreach(App\Models\UserDetail::SPOUSE_SEX_RADIO as $key => $label)
                <div class="form-check {{ $errors->has('spouse_sex') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="radio" id="spouse_sex_{{ $key }}" name="spouse_sex"
                        value="{{ $key }}"
                        {{ old('spouse_sex', $userDetail->spouse_sex) === (string) $key ? 'checked' : '' }}>
                    <label class="form-check-label" for="spouse_sex_{{ $key }}">{{ $label }}</label>
                </div>
                @endforeach
                @if($errors->has('spouse_sex'))
                <span class="text-danger">{{ $errors->first('spouse_sex') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_sex_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_phone_1">{{ trans('cruds.userDetail.fields.spouse_phone_1') }}</label>
                <input class="form-control {{ $errors->has('spouse_phone_1') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_phone_1" id="spouse_phone_1"
                    value="{{ old('spouse_phone_1', $userDetail->spouse_phone_1) }}">
                @if($errors->has('spouse_phone_1'))
                <span class="text-danger">{{ $errors->first('spouse_phone_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_phone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_phone_2">{{ trans('cruds.userDetail.fields.spouse_phone_2') }}</label>
                <input class="form-control {{ $errors->has('spouse_phone_2') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_phone_2" id="spouse_phone_2"
                    value="{{ old('spouse_phone_2', $userDetail->spouse_phone_2) }}">
                @if($errors->has('spouse_phone_2'))
                <span class="text-danger">{{ $errors->first('spouse_phone_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_mobile_no">{{ trans('cruds.userDetail.fields.spouse_mobile_no') }}</label>
                <input class="form-control {{ $errors->has('spouse_mobile_no') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_mobile_no" id="spouse_mobile_no" value="{{$userProfile['SPOUSEMOBILENO'] }}">
                @if($errors->has('spouse_mobile_no'))
                <span class="text-danger">{{ $errors->first('spouse_mobile_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_mobile_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_email">{{ trans('cruds.userDetail.fields.spouse_email') }}</label>
                <input class="form-control {{ $errors->has('spouse_email') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_email" id="spouse_email" value="{{ old('spouse_email', $userDetail->spouse_email) }}">
                @if($errors->has('spouse_email'))
                <span class="text-danger">{{ $errors->first('spouse_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="anniversary_date">{{ trans('cruds.userDetail.fields.anniversary_date') }}</label>
                <input class="form-control date {{ $errors->has('anniversary_date') ? 'is-invalid' : '' }}" type="text"
                    name="anniversary_date" id="anniversary_date" value="{{$userProfile['ANNIVERSARY_DATE'] }}">
                @if($errors->has('anniversary_date'))
                <span class="text-danger">{{ $errors->first('anniversary_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.anniversary_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label
                    for="spouse_business_profession">{{ trans('cruds.userDetail.fields.spouse_business_profession') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_profession') ? 'is-invalid' : '' }}"
                    type="text" name="spouse_business_profession" id="spouse_business_profession"
                    value="{{ old('spouse_business_profession', $userDetail->spouse_business_profession) }}">
                @if($errors->has('spouse_business_profession'))
                <span class="text-danger">{{ $errors->first('spouse_business_profession') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_profession_helper') }}</span>
            </div>
            <div class="form-group">
                <label
                    for="spouse_business_category">{{ trans('cruds.userDetail.fields.spouse_business_category') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_category') ? 'is-invalid' : '' }}"
                    type="text" name="spouse_business_category" id="spouse_business_category"
                    value="{{ old('spouse_business_category', $userDetail->spouse_business_category) }}">
                @if($errors->has('spouse_business_category'))
                <span class="text-danger">{{ $errors->first('spouse_business_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label
                    for="spouse_business_address_1">{{ trans('cruds.userDetail.fields.spouse_business_address_1') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_address_1') ? 'is-invalid' : '' }}"
                    type="text" name="spouse_business_address_1" id="spouse_business_address_1"
                    value="{{ old('spouse_business_address_1', $userDetail->spouse_business_address_1) }}">
                @if($errors->has('spouse_business_address_1'))
                <span class="text-danger">{{ $errors->first('spouse_business_address_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_address_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label
                    for="spouse_business_address_2">{{ trans('cruds.userDetail.fields.spouse_business_address_2') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_address_2') ? 'is-invalid' : '' }}"
                    type="text" name="spouse_business_address_2" id="spouse_business_address_2"
                    value="{{ old('spouse_business_address_2', $userDetail->spouse_business_address_2) }}">
                @if($errors->has('spouse_business_address_2'))
                <span class="text-danger">{{ $errors->first('spouse_business_address_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label
                    for="spouse_business_address_3">{{ trans('cruds.userDetail.fields.spouse_business_address_3') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_address_3') ? 'is-invalid' : '' }}"
                    type="text" name="spouse_business_address_3" id="spouse_business_address_3"
                    value="{{ old('spouse_business_address_3', $userDetail->spouse_business_address_3) }}">
                @if($errors->has('spouse_business_address_3'))
                <span class="text-danger">{{ $errors->first('spouse_business_address_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_address_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_business_city">{{ trans('cruds.userDetail.fields.spouse_business_city') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_city') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_business_city" id="spouse_business_city"
                    value="{{ old('spouse_business_city', $userDetail->spouse_business_city) }}">
                @if($errors->has('spouse_business_city'))
                <span class="text-danger">{{ $errors->first('spouse_business_city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_business_state">{{ trans('cruds.userDetail.fields.spouse_business_state') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_state') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_business_state" id="spouse_business_state"
                    value="{{ old('spouse_business_state', $userDetail->spouse_business_state) }}">
                @if($errors->has('spouse_business_state'))
                <span class="text-danger">{{ $errors->first('spouse_business_state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_business_pin">{{ trans('cruds.userDetail.fields.spouse_business_pin') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_pin') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_business_pin" id="spouse_business_pin"
                    value="{{ old('spouse_business_pin', $userDetail->spouse_business_pin) }}">
                @if($errors->has('spouse_business_pin'))
                <span class="text-danger">{{ $errors->first('spouse_business_pin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_pin_helper') }}</span>
            </div>
            <div class="form-group">
                <label
                    for="spouse_business_phone_1">{{ trans('cruds.userDetail.fields.spouse_business_phone_1') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_phone_1') ? 'is-invalid' : '' }}"
                    type="text" name="spouse_business_phone_1" id="spouse_business_phone_1"
                    value="{{ old('spouse_business_phone_1', $userDetail->spouse_business_phone_1) }}">
                @if($errors->has('spouse_business_phone_1'))
                <span class="text-danger">{{ $errors->first('spouse_business_phone_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_phone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label
                    for="spouse_business_phone_2">{{ trans('cruds.userDetail.fields.spouse_business_phone_2') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_phone_2') ? 'is-invalid' : '' }}"
                    type="text" name="spouse_business_phone_2" id="spouse_business_phone_2"
                    value="{{ old('spouse_business_phone_2', $userDetail->spouse_business_phone_2) }}">
                @if($errors->has('spouse_business_phone_2'))
                <span class="text-danger">{{ $errors->first('spouse_business_phone_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_business_email">{{ trans('cruds.userDetail.fields.spouse_business_email') }}</label>
                <input class="form-control {{ $errors->has('spouse_business_email') ? 'is-invalid' : '' }}" type="text"
                    name="spouse_business_email" id="spouse_business_email"
                    value="{{ old('spouse_business_email', $userDetail->spouse_business_email) }}">
                @if($errors->has('spouse_business_email'))
                <span class="text-danger">{{ $errors->first('spouse_business_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_business_email_helper') }}</span>
            </div>

            <div class="form-group">
                <img class="img-fluid" src="data:image/png;base64,                          
                    {{ $userProfile['MemberImage'] }}" width="300" height="300" alt="" />
            </div>

            <div class="form-group">
                <img class="img-fluid" src="data:image/png;base64,                          
                    {{ $userProfile['SpouseImage'] }}" width="300" height="50" alt="" />
            </div>



            <div class="form-group">
                <label for="member_image">{{ trans('cruds.userDetail.fields.member_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('member_image') ? 'is-invalid' : '' }}"
                    id="member_image-dropzone">
                </div>
                @if($errors->has('member_image'))
                <span class="text-danger">{{ $errors->first('member_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.member_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spouse_image">{{ trans('cruds.userDetail.fields.spouse_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('spouse_image') ? 'is-invalid' : '' }}"
                    id="spouse_image-dropzone">
                </div>
                @if($errors->has('spouse_image'))
                <span class="text-danger">{{ $errors->first('spouse_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.spouse_image_helper') }}</span>
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
Dropzone.options.memberImageDropzone = {
    url: '{{ route('admin.user-details.storeMedia') }}',
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
        $('form').find('input[name="member_image"]').remove()
        $('form').append('<input type="hidden" name="member_image" value="' + response.name + '">')
    },
    removedfile: function(file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="member_image"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
    },
    init: function() {
        @if(isset($userDetail) && $userDetail -> member_image)
        var file = {
            !!json_encode($userDetail -> member_image) !!
        }
        this.options.addedfile.call(this, file)
        this.options.thumbnail.call(this, file, file.preview)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="member_image" value="' + file.file_name + '">')
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
Dropzone.options.spouseImageDropzone = {
    url: '{{ route('admin.user-details.storeMedia') }}',
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
        $('form').find('input[name="spouse_image"]').remove()
        $('form').append('<input type="hidden" name="spouse_image" value="' + response.name + '">')
    },
    removedfile: function(file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="spouse_image"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
    },
    init: function() {
        @if(isset($userDetail) && $userDetail -> spouse_image)
        var file = {
            !!json_encode($userDetail -> spouse_image) !!
        }
        this.options.addedfile.call(this, file)
        this.options.thumbnail.call(this, file, file.preview)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="spouse_image" value="' + file.file_name + '">')
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