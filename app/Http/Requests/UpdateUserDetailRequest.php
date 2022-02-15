<?php

namespace App\Http\Requests;

use App\Models\UserDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_detail_edit');
    }

    public function rules()
    {
        return [];
    }
}
