<?php

namespace App\Http\Requests;

use App\Models\CommitteeName;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCommitteeNameRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('committee_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:committee_names,id',
        ];
    }
}
