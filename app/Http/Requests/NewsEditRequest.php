<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsEditRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'regex:/[a-zA-Z0-9\s]+/', 'max:400']
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title field is required.',
            'title.string' => 'Title can only contain alphabetic characters and empty spaces.',
            'title.max' => 'Title cannot contain more than 100 characters.',
            'description.required' => 'Description field is required.',
            'description.regex' => 'Description can only contain alphabetic characters, numeric characters and empty spaces.',
            'description.max' => 'Description cannot contain more than 400 characters.'
        ];
    }
}
