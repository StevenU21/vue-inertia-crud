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
            'title.required' => 'El Campo de Título es Requerido.',
            'title.string' => 'El Campo de Título debe ser un Texto.',
            'title.min' => 'El Campo de Título debe tener al menos :min Caracteres.',
            'title.max' => 'El Campo de Título no debe tener más de :max Caracteres.',
            'description.required' => 'El Campo de Descripción es Requerido.',
            'description.string' => 'El Campo de Descripción debe ser un Texto.',
            'description.min' => 'El Campo de Descripción debe tener al menos :min Caracteres.',
            'description.max' => 'El Campo de Descripción no debe tener más de :max Caracteres.',
            'author.required' => 'El Campo de Autor es Requerido.',
            'author.string' => 'El Campo de Autor debe ser un Texto.',
            'author.min' => 'El Campo de Autor debe tener al menos :min Caracteres.',
            'author.max' => 'El Campo de Autor no debe tener más de :max Caracteres.',
            'release_date.required' => 'El Campo de Fecha de Lanzamiento es Requerido.',
            'release_date.date' => 'El Campo de Fecha de Lanzamiento debe ser una Fecha.',
            'genre_id.required' => 'El Campo de Género es Requerido.',
            'genre_id.exists' => 'El Género Seleccionado no Existe.'
        ];
    }
}
