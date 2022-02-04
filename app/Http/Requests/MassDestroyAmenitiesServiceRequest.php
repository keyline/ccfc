<?php

namespace App\Http\Requests;

use App\Models\AmenitiesService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAmenitiesServiceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('amenities_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:amenities_services,id',
        ];
    }
}
