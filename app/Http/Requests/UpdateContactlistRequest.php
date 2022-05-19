<?php

namespace App\Http\Requests;

use App\Models\Contactlist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactlistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contactlist_edit');
    }

    public function rules()
    {
        return [
            'department_name' => [
                'string',
                'required',
            ],
            'department_email' => [
                'string',
                'required',
            ],
        ];
    }
}
