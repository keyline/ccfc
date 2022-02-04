<?php

namespace App\Http\Requests;

use App\Models\Sportstype;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySportstypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sportstype_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sportstypes,id',
        ];
    }
}
