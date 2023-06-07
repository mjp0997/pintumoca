<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncreaseStockRequest extends FormRequest
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
            'stock_id' => [
                'required', 'integer', 'exists:stocks,id'
            ],
            'stock' => [
                'required', 'integer', 'gt:0'
            ],
        ];
    }

    public function messages()
    {
        return [
            'stock_id.required' => 'Este campo es obligatorio',
            'stock_id.integer' => 'Este campo debe ser un valor entero',
            'stock_id.exists' => 'El valor ingresado no se encuentra en la base de datos',
            'stock.required' => 'Este campo es obligatorio',
            'stock.integer' => 'Este campo debe ser un valor entero',
            'stock.exists' => 'Este campo debe ser mayor a 0',
        ];
    }
}
