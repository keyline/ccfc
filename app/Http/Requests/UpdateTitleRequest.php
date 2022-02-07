<?php

namespace App\Http\Requests;

use App\Models\Title;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTitleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('title_edit');
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
