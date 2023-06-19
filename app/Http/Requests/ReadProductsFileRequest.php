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
            'import' => 'required|file'
        ];
    }

    public function messages()
    {
        return [
            'import.required' => 'Este campo es obligatorio',
            'import.file' => 'Este campo debe ser un archivo',
        ];
    }
}
