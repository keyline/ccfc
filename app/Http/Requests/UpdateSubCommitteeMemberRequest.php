<?php

namespace App\Http\Requests;

use App\Models\SubCommitteeMember;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSubCommitteeMemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sub_committee_member_edit');
    }

    public function rules()
    {
        return [
            'comittee_name_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
