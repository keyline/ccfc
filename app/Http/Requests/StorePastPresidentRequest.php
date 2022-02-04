<?php

namespace App\Http\Requests;

use App\Models\PastPresident;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePastPresidentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('past_president_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'duration' => [
                'string',
                'nullable',
            ],
            'short_order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
