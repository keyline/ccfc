<?php

namespace App\Http\Requests;

use App\Models\Sportsman;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSportsmanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sportsman_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
