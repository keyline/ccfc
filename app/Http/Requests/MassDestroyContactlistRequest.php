<?php

namespace App\Http\Requests;

use App\Models\Contactlist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyContactlistRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('contactlist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:department_name,department_email,id',
        ];
    }
}
