<?php

namespace App\Http\Requests;

use App\Models\CommitteeName;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCommitteeNameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('committee_name_create');
    }

    public function rules()
    {
        return [
            'committee_name_master' => [
                'string',
                'required',
            ],
        ];
    }
}
