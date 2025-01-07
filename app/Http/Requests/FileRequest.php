<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
        $baseRules = [
            'mime_type' => 'required|in:Music,Image,Document',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        $fileRules = $this->getFileValidationRules($this->input('mime_type'));

        return array_merge($baseRules, $fileRules);
    }

    /**
     * Get file validation rules based on mime_type.
     */
    private function getFileValidationRules(?string $mimeType): array
    {
        $rulesByType = [
            'Image' => 'required|file|mimes:png,jpg,jpeg,webp|max:2048', // 2MB
            'Document' => 'required|file|mimes:txt,pdf,docx,xlsx,pptx|max:6144', // 6MB
            'Music' => 'required|file|mimes:mp3,m4a|max:10240', // 10MB
        ];

        return [
            'file' => $rulesByType[$mimeType] ?? 'required|file',
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
            'mime_type.required' => 'El Campo de Tipo de Archivo es Requerido.',
            'mime_type.in' => 'El Campo de Tipo de Archivo no es Válido.',
            'name.required' => 'El Campo de Nombre es Requerido.',
            'name.string' => 'El Campo de Nombre debe ser un Texto.',
            'name.max' => 'El Campo de Nombre no debe tener más de :max Caracteres.',
            'description.string' => 'El Campo de Descripción debe ser un Texto.',
            'file.required' => 'El Campo de Archivo es Requerido.',
            'file.file' => 'El Campo de Archivo debe ser un Archivo.',
            'file.mimes' => 'El Archivo debe ser de Tipo: :values.',
            'file.max' => 'El Archivo no debe tener más de :max Kilobytes.'
        ];
    }
}
