<?php

namespace App\Http\Requests;

use App\Models\ReciprocalClub;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReciprocalClubRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reciprocal_club_create');
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
            'cub_type' => [
                'required',
            ],
        ];
    }
}
