<?php

namespace App\Http\Requests;

use App\Models\ReciprocalClub;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReciprocalClubRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reciprocal_club_edit');
    }

    public function rules()
    {
        return [
            'reciprocal_club_name' => [
                'string',
                'required',
            ],
            'address_1' => [
                'string',
                'nullable',
            ],
            'address_2' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'website' => [
                'string',
                'nullable',
            ],
        ];
    }
}
