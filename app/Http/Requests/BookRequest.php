<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:6', 'max:60'],
            'description' => ['required', 'string', 'min:6', 'max:255'],
            'author' => ['required', 'string', 'min:6', 'max:30'],
            'release_date' => ['required', 'date'],
            'genre_id' => ['required', 'exists:genres,id']
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
            'title.required' => 'The Title Field is Required.',
            'title.string' => 'The Title Field must be a String.',
            'title.min' => 'The Title Field must be at least :min Characters.',
            'title.max' => 'The Title Field must not exceed :max Characters.',
            'description.required' => 'The Description Field is Required.',
            'description.string' => 'The Description Field must be a String.',
            'description.min' => 'The Description Field must be at least :min Characters.',
            'description.max' => 'The Description Field must not exceed :max Characters.',
            'author.required' => 'The Author Field is Required.',
            'author.string' => 'The Author Field must be a String.',
            'author.min' => 'The Author Field must be at least :min Characters.',
            'author.max' => 'The Author Field must not exceed :max Characters.',
            'release_date.required' => 'The Release Date Field is Required.',
            'release_date.date' => 'The Release Date Field must be a Date.',
            'genre_id.required' => 'The Genre Field is Required.',
            'genre_id.exists' => 'The Genre Field must be a Valid Genre.'
        ];
    }
}
