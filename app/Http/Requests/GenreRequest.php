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
            'name' => ['required', 'string', 'min:6', 'max:30', 'unique:genres,name' . Rule::unique('genres')->ignore($this->genre)],
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
            'name.required' => 'El Campo de Nombre es Requerido.',
            'name.string' => 'El Campo de Nombre debe ser un Texto.',
            'name.min' => 'El Campo de Nombre debe tener al menos :min Caracteres.',
            'name.max' => 'El Campo de Nombre no debe tener más de :max Caracteres.',
            'name.unique' => 'El Nombre Ingresado ya Existe.',
            'description.required' => 'El Campo de Descripción es Requerido.',
            'description.string' => 'El Campo de Descripción debe ser un Texto.',
            'description.min' => 'El Campo de Descripción debe tener al menos :min Caracteres.',
            'description.max' => 'El Campo de Descripción no debe tener más de :max Caracteres.'
        ];
    }
}
