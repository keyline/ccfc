<?php

namespace App\Http\Requests;

use App\Models\Contactlist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactlistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contactlist_create');
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
