<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'type' => ['required'],
            'title' => ['required', 'max:100'],
            'description' => ['required', 'regex:/[a-zA-Z0-9\s]+/', 'max:400'],
            'location' => ['required', 'max:100'],
            'date' => ['required'],
            'images' => ['required', 'max:4']
        ];
    }
    public function messages()
    {
        return [
            'type.required' => 'Type selection is required.',
            'title.required' => 'Title field is required.',
            'title.max' => 'Title cannot contain more than 100 characters',
            'description.required' => 'Description field is required.',
            'description.regex' => 'Description can only contain alphabetic characters, numeric characters and empty spaces.',
            'description.max' => 'Description cannot contain more than 400 characters.',
            'location.required' => 'Location field is required.',
            'location.max' => 'Location cannot contain more than 100 characters.',
            'date.required' => ' Date field is required.',
            'images.required' => 'Image upload is required.'
        ];
    }
}
