<?php

namespace App\Http\Requests;

use App\Models\Title;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTitleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('title_create');
    }

    public function rules()
    {
        return [
            'titles' => [
                'string',
                'required',
            ],
        ];
    }
}
