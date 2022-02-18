<?php

namespace App\Http\Requests;

use App\Models\UserDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_detail_edit');
    }

    public function rules()
    {
        return [
            'user_code_id' => [
                'required',
                'integer',
            ],
            'member_type_code' => [
                'string',
                'required',
            ],
            'member_type' => [
                'string',
                'nullable',
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'member_since' => [
                'string',
                'nullable',
            ],
            'address_1' => [
                'string',
                'nullable',
            ],
            'address_2' => [
                'string',
                'nullable',
            ],
            'address_3' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'state' => [
                'string',
                'nullable',
            ],
            'pin' => [
                'string',
                'nullable',
            ],
            'phone_1' => [
                'string',
                'nullable',
            ],
            'phone_2' => [
                'string',
                'nullable',
            ],
            'mobile_no' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'current_status' => [
                'string',
                'nullable',
            ],
            'represented_club_in' => [
                'string',
                'nullable',
            ],
            'hobbies_interest' => [
                'string',
                'nullable',
            ],
            'business_profession' => [
                'string',
                'nullable',
            ],
            'category' => [
                'string',
                'nullable',
            ],
            'business_address_1' => [
                'string',
                'nullable',
            ],
            'business_address_2' => [
                'string',
                'nullable',
            ],
            'business_address_3' => [
                'string',
                'nullable',
            ],
            'business_city' => [
                'string',
                'nullable',
            ],
            'business_state' => [
                'string',
                'nullable',
            ],
            'business_pin' => [
                'string',
                'nullable',
            ],
            'business_phone_1' => [
                'string',
                'nullable',
            ],
            'business_phone_2' => [
                'string',
                'nullable',
            ],
            'business_email' => [
                'string',
                'nullable',
            ],
            'spouse_name' => [
                'string',
                'nullable',
            ],
            'spouse_dob' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'spouse_phone_1' => [
                'string',
                'nullable',
            ],
            'spouse_phone_2' => [
                'string',
                'nullable',
            ],
            'spouse_mobile_no' => [
                'string',
                'nullable',
            ],
            'spouse_email' => [
                'string',
                'nullable',
            ],
            'anniversary_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'spouse_business_profession' => [
                'string',
                'nullable',
            ],
            'spouse_business_category' => [
                'string',
                'nullable',
            ],
            'spouse_business_address_1' => [
                'string',
                'nullable',
            ],
            'spouse_business_address_2' => [
                'string',
                'nullable',
            ],
            'spouse_business_address_3' => [
                'string',
                'nullable',
            ],
            'spouse_business_city' => [
                'string',
                'nullable',
            ],
            'spouse_business_state' => [
                'string',
                'nullable',
            ],
            'spouse_business_pin' => [
                'string',
                'nullable',
            ],
            'spouse_business_phone_1' => [
                'string',
                'nullable',
            ],
            'spouse_business_phone_2' => [
                'string',
                'nullable',
            ],
            'spouse_business_email' => [
                'string',
                'nullable',
            ],
        ];
    }
}
