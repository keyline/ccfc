<?php

namespace App\Http\Requests;

use App\Models\Trophy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTrophyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trophy_create');
    }

    public function rules()
    {
        return [
            'trophy' => [
                'string',
                'required',
            ],
            'year_of_award' => [
                'string',
                'nullable',
            ],
        ];
    }
}
