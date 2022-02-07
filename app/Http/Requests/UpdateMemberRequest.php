<?php

namespace App\Http\Requests;

use App\Models\Member;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('member_edit');
    }

    public function rules()
    {
        return [
            'select_member_id' => [
                'required',
                'integer',
            ],
            'select_title_id' => [
                'required',
                'integer',
            ],
<<<<<<< HEAD
            'select_sport_id' => [
                'required',
                'integer',
            ],
=======
>>>>>>> origin/quickadminpanel_2022_02_04_04_54_33
        ];
    }
}
