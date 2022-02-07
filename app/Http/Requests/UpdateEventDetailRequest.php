<?php

namespace App\Http\Requests;

use App\Models\EventDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_detail_edit');
    }

    public function rules()
    {
        return [
            'event_title' => [
                'string',
                'required',
            ],
            'event_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
