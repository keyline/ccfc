<?php

namespace App\Http\Requests;

use App\Models\CommitteeMemberMapping;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCommitteeMemberMappingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('committee_member_mapping_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:committee_member_mappings,id',
        ];
    }
}
