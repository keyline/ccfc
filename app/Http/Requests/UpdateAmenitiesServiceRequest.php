<?php

namespace App\Http\Requests;

use App\Models\AmenitiesService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAmenitiesServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('amenities_service_edit');
    }

    public function rules()
    {
        return [
            'amenity_name' => [
                'string',
                'required',
            ],
        ];
    }
}
