<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTenderuploadsRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tenderupload_create');
    }

    public function rules()
    {
        return [
            'tender_title' => 'required|string|max:40',
            'tender_description' => 'nullable|string|max:100',
            'tender_files' => 'required|array',
            'folder_year'  => 'required' ,
            //'tender_files.*' => 'file|mimes:pdf|max:2048', // Max file size 2MB per file
        ];
    }

    public function messages()
    {
        return [
            'tender_title.required' => 'Please enter a title.',
            'tender_title.string' => 'Title must be a string.',
            'tender_title.max' => 'Title may not be greater than 255 characters.',
            'tender_description.string' => 'Description must be a string.',
            'tender_files.required' => 'Please upload at least one PDF file.',
            //'tender_files.*.file' => 'The file must be a file.',
            //'tender_files.*.mimes' => 'The file must be a PDF.',
            //'tender_files.*.max' => 'The file size of each PDF must be less than 2MB.',
            'folder_year'       => 'Please select a year',
        ];
    }

    /*public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {
                // Dump the request data if there are validation errors
                dd($this->all());
            }
        });
    }*/
}
