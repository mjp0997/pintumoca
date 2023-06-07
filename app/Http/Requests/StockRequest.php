<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            'product_id' => [
                'required', 'integer', 'exists:products,id'
            ],
            'office_id' => [
                'required', 'integer', 'exists:offices,id'
            ],
            'stock' => [
                'required', 'integer', 'min:0'
            ],
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Este campo es obligatorio',
            'product_id.integer' => 'Este campo debe ser un valor entero',
            'product_id.exists' => 'El valor ingresado no se encuentra en la base de datos',
            'office_id.required' => 'Este campo es obligatorio',
            'office_id.integer' => 'Este campo debe ser un valor entero',
            'office_id.exists' => 'El valor ingresado no se encuentra en la base de datos',
            'stock.required' => 'Este campo es obligatorio',
            'stock.integer' => 'Este campo debe ser un valor entero',
            'stock.exists' => 'Este campo debe ser mayor o igual a 0',
        ];
    }
}
