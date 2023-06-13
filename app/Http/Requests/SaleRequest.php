<?php

namespace App\Http\Requests;

use App\Rules\EnoughCartStock;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'client_name' => 'nullable',
            'office_id' => 'required|integer|exists:offices,id',

            'cart' => 'required|array|min:1',
            'cart.*.product_id' => 'required|integer|exists:products,id',
            'cart.*.quantity' => ['bail', 'required', 'integer', 'gt:0', new EnoughCartStock()],
            'cart.*.price' => 'required|decimal:0,2|gt:0',

            'payments' => 'nullable|array',
            'payments.*.payment_id' => 'required|integer|exists:payment_methods,id',
            'payments.*.currency_id' => 'required|integer|exists:currencies,id',
            'payments.*.amount' => 'required|decimal:0,2|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'office_id.required' => 'Este campo es obligatorio',
            'office_id.integer' => 'Este campo debe ser un valor entero',
            'office_id.exists' => 'El valor seleccionado no se encuentra en la base de datos',

            'cart.required' => 'Este campo es obligatorio',
            'cart.array' => 'Este campo debe ser un valor array',
            'cart.min' => 'Debe agregar al menos un producto',
            
            'cart.*.product_id.required' => 'Este campo es obligatorio',
            'cart.*.product_id.integer' => 'Este campo debe ser un valor entero',
            'cart.*.product_id.exists' => 'El valor seleccionado no se encuentra en la base de datos',
            'cart.*.quantity.required' => 'Este campo es obligatorio',
            'cart.*.quantity.integer' => 'Este campo debe ser un valor entero',
            'cart.*.quantity.gt' => 'Este campo debe ser mayor a 0',
            'cart.*.price.required' => 'Este campo es obligatorio',
            'cart.*.price.decimal' => 'Este campo debe ser un valor decimal con un máximo de 2 decimales',
            'cart.*.price.gt' => 'Este campo debe ser mayor a 0',

            'payments.array' => 'Este campo debe ser un valor array',
            
            'payments.*.payment_id.required' => 'Este campo es obligatorio',
            'payments.*.payment_id.integer' => 'Este campo debe ser un valor entero',
            'payments.*.payment_id.exists' => 'El valor seleccionado no se encuentra en la base de datos',
            'payments.*.currency_id.required' => 'Este campo es obligatorio',
            'payments.*.currency_id.integer' => 'Este campo debe ser un valor entero',
            'payments.*.currency_id.exists' => 'El valor seleccionado no se encuentra en la base de datos',
            'payments.*.amount.required' => 'Este campo es obligatorio',
            'payments.*.amount.decimal' => 'Este campo debe ser un valor decimal con un máximo de 2 decimales',
            'payments.*.amount.gt' => 'Este campo debe ser mayor a 0',
        ];
    }
}
