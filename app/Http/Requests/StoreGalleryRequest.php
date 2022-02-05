<?php

namespace App\Http\Requests;

use App\Models\Gallery;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGalleryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gallery_create');
    }

    public function rules()
    {
        return [
            'gallery_name' => [
                'string',
                'required',
            ],
            'gallery_type' => [
                'required',
            ],
            'images' => [
                'array',
            ],
        ];
    }
}
