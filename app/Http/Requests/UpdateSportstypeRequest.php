<?php

namespace App\Http\Requests;

use App\Models\Sportstype;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSportstypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sportstype_edit');
    }

    public function rules()
    {
        return [
            'sport_name' => [
                'string',
                'required',
            ],
        ];
    }
}
