<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'file' => ['required', 'array', 'min:1', 'max:10'],
            'file.*' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'files.required' => 'Please select at least one image.',
            'files.array' => 'The selected files must be an array.',
            'files.min' => 'Please select at least one image.',
            'files.max' => 'You can only upload a maximum of 10 images.',
            'files.*.required' => 'The image field is required.',
            'files.*.image' => 'The file must be an image.',
            'files.*.mimes' => 'The image must be a file of type: jpeg, png, jpg, webp.',
            'files.*.max' => 'The image may not be greater than 2MB.',
        ];
    }
}
