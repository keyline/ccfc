<?php

namespace App\Http\Requests;

use App\Models\CommitteeMemberMapping;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCommitteeMemberMappingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('committee_member_mapping_create');
    }

    public function rules()
    {
        return [
            'committee_id' => [
                'required',
                'integer',
            ],
            'member_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
