@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $userDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.user_code') }}
                        </th>
                        <td>
                            {{ $userDetail->user_code->user_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.member_type_code') }}
                        </th>
                        <td>
                            {{ $userDetail->member_type_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.member_type') }}
                        </th>
                        <td>
                            {{ $userDetail->member_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $userDetail->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.member_since') }}
                        </th>
                        <td>
                            {{ $userDetail->member_since }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.sex') }}
                        </th>
                        <td>
                            {{ App\Models\UserDetail::SEX_RADIO[$userDetail->sex] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.address_1') }}
                        </th>
                        <td>
                            {{ $userDetail->address_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.address_2') }}
                        </th>
                        <td>
                            {{ $userDetail->address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.address_3') }}
                        </th>
                        <td>
                            {{ $userDetail->address_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.city') }}
                        </th>
                        <td>
                            {{ $userDetail->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.state') }}
                        </th>
                        <td>
                            {{ $userDetail->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.pin') }}
                        </th>
                        <td>
                            {{ $userDetail->pin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.phone_1') }}
                        </th>
                        <td>
                            {{ $userDetail->phone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.phone_2') }}
                        </th>
                        <td>
                            {{ $userDetail->phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.mobile_no') }}
                        </th>
                        <td>
                            {{ $userDetail->mobile_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.email') }}
                        </th>
                        <td>
                            {{ $userDetail->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.current_status') }}
                        </th>
                        <td>
                            {{ $userDetail->current_status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.represented_club_in') }}
                        </th>
                        <td>
                            {{ $userDetail->represented_club_in }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.hobbies_interest') }}
                        </th>
                        <td>
                            {{ $userDetail->hobbies_interest }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_profession') }}
                        </th>
                        <td>
                            {{ $userDetail->business_profession }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.category') }}
                        </th>
                        <td>
                            {{ $userDetail->category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_address_1') }}
                        </th>
                        <td>
                            {{ $userDetail->business_address_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_address_2') }}
                        </th>
                        <td>
                            {{ $userDetail->business_address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_address_3') }}
                        </th>
                        <td>
                            {{ $userDetail->business_address_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_city') }}
                        </th>
                        <td>
                            {{ $userDetail->business_city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_state') }}
                        </th>
                        <td>
                            {{ $userDetail->business_state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_pin') }}
                        </th>
                        <td>
                            {{ $userDetail->business_pin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_phone_1') }}
                        </th>
                        <td>
                            {{ $userDetail->business_phone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_phone_2') }}
                        </th>
                        <td>
                            {{ $userDetail->business_phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_email') }}
                        </th>
                        <td>
                            {{ $userDetail->business_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_name') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_dob') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_sex') }}
                        </th>
                        <td>
                            {{ App\Models\UserDetail::SPOUSE_SEX_RADIO[$userDetail->spouse_sex] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_phone_1') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_phone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_phone_2') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_mobile_no') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_mobile_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_email') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.anniversary_date') }}
                        </th>
                        <td>
                            {{ $userDetail->anniversary_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_profession') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_profession }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_category') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_address_1') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_address_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_address_2') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_address_3') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_address_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_city') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_state') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_pin') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_pin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_phone_1') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_phone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_phone_2') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_email') }}
                        </th>
                        <td>
                            {{ $userDetail->spouse_business_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.member_image') }}
                        </th>
                        <td>
                            @if($userDetail->member_image)
                                <a href="{{ $userDetail->member_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $userDetail->member_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_image') }}
                        </th>
                        <td>
                            @if($userDetail->spouse_image)
                                <a href="{{ $userDetail->spouse_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $userDetail->spouse_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection