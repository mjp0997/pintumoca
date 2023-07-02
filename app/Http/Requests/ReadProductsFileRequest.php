<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReadProductsFileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'route' => 'required|string|in:mass-create,mass-edit',
            'import' => 'required|file'
        ];
    }

    public function messages()
    {
        return [
            'route.required' => 'Este campo es obligatorio',
            'route.string' => 'Este campo debe ser un string',
            'route.in' => 'Este campo debe ser "mass-create" o "mass-edit"',
            'import.required' => 'Este campo es obligatorio',
            'import.file' => 'Este campo debe ser un archivo',
        ];
    }
}
