<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GenreRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:6', 'max:30', Rule::unique('genres')->ignore($this->genre)],
            'description' => ['required', 'string', 'min:6', 'max:255']
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
            'name.required' => 'The Name Field is Required.',
            'name.string' => 'The Name Field must be a String.',
            'name.min' => 'The Name Field must be at least :min Characters.',
            'name.max' => 'The Name Field must not exceed :max Characters.',
            'name.unique' => 'The Name Field must be Unique.',
            'description.required' => 'The Description Field is Required.',
            'description.string' => 'The Description Field must be a String.',
            'description.min' => 'The Description Field must be at least :min Characters.',
            'description.max' => 'The Description Field must not exceed :max Characters.'
        ];
    }
}
