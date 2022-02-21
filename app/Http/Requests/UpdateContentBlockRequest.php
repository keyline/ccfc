<?php

namespace App\Http\Requests;

use App\Models\ContentBlock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContentBlockRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('content_block_edit');
    }

    public function rules()
    {
        return [
            'name_of_the_block' => [
                'string',
                'nullable',
            ],
            'heading' => [
                'string',
                'nullable',
            ],
        ];
    }
}
