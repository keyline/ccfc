<?php

namespace App\Http\Requests;

use App\Models\SubCommitteeMember;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySubCommitteeMemberRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sub_committee_member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sub_committee_members,id',
        ];
    }
}
