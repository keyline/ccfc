<?php

namespace App\Http\Requests;

use App\Models\EventDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_detail_create');
    }

    public function rules()
    {
        return [
            'event_title' => [
                'string',
                'required',
            ],
            'event_image' => [
                'array',
            ],
        ];
    }
}
