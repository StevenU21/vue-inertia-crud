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
    public function rules(): array
    {
        return [
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048']
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
            'file.required' => 'The Image Field is Required.',
            'file.image' => 'The Image Field must be an Image.',
            'file.mimes' => 'The Image Field must be a File of Type: :values.',
            'file.max' => 'The Image Field must not exceed :max Kilobytes.'
        ];
    }
}
