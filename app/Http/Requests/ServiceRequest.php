<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string']
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title field is required.',
            'title.string' => 'Title can only contain alphabetic characters and empty spaces.'
        ];
    }
}
