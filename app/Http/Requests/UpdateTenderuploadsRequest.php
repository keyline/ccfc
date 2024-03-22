<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;

class UpdateTenderuploadsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('tenderupload_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tender_title' => 'required|string|max:500',
            'tender_description' => 'required|string|max:1200',
            'tender_files' => 'required|array',
            //'tender_files.*' => 'file|mimes:pdf|max:2048', // Max file size 2MB per file
            'folder_year'  => 'required' ,
        ];
    }

    public function messages()
    {
        return [
            'tender_title.required' => 'Please enter a title.',
            'tender_title.string' => 'Title must be a string.',
            'tender_title.max' => 'Title may not be greater than 500 characters.',
            'tender_description.required' => 'Please enter a decription ',
            'tender_description.string' => 'Description must be a string.',
            'tender_description.max' => 'Description may not be greater than 1200 characters',
            'tender_files.required' => 'Please upload at least one PDF file.',
            'tender_descrption.max' => 'Title may not be greater than 100 characters.',
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
