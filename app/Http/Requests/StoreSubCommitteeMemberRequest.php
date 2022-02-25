<?php

namespace App\Http\Requests;

use App\Models\SubCommitteeMember;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubCommitteeMemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sub_committee_member_create');
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
