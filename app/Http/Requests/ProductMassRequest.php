<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductMassRequest extends FormRequest
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
            'products' => 'required|array|min:1',
            'products.*.code' => 'required|string',
            'products.*.name' => 'required|string',
            'products.*.offices' => 'required|array|min:1',
            'products.*.offices.*' => 'required|integer|min:0',

            'all_products' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'Este campo es obligatorio',
            'products.array' => 'Este campo debe ser un arreglo',
            'products.min' => 'Este campo debe contener al menos 1 registro',
            'products.*.code.required' => 'Este campo es obligatorio',
            'products.*.code.string' => 'Este campo debe ser una cadena de caracteres',
            'products.*.name.required' => 'Este campo es obligatorio',
            'products.*.name.string' => 'Este campo debe ser una cadena de caracteres',
            'products.*.offices.required' => 'Este campo es obligatorio',
            'products.*.offices.array' => 'Este campo debe ser un arreglo',
            'products.*.offices.min' => 'Este campo debe contener al menos 1 registro',
            'products.*.offices.*.required' => 'Este campo es obligatorio',
            'products.*.offices.*.array' => 'Este campo debe ser un entero',
            'products.*.offices.*.min' => 'Este campo debe ser mayor o igual a 0',

            'all_products.boolean' => 'Este campo debe ser verdadero o falso'
        ];
    }
}
