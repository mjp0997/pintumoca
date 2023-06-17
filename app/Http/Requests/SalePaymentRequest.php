<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalePaymentRequest extends FormRequest
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
            'sale_id' => 'required|integer|exists:sales,id',
            'payment_id' => 'required|integer|exists:payment_methods,id',
            'currency_id' => 'required|integer|exists:currencies,id',
            'amount' => 'required|decimal:0,2|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'sale_id.required' => 'Este campo es obligatorio',
            'sale_id.integer' => 'Este campo debe ser un valor entero',
            'sale_id.exists' => 'El valor seleccionado no se encuentra en la base de datos',
            'payment_id.required' => 'Este campo es obligatorio',
            'payment_id.integer' => 'Este campo debe ser un valor entero',
            'payment_id.exists' => 'El valor seleccionado no se encuentra en la base de datos',
            'currency_id.required' => 'Este campo es obligatorio',
            'currency_id.integer' => 'Este campo debe ser un valor entero',
            'currency_id.exists' => 'El valor seleccionado no se encuentra en la base de datos',
            'amount.required' => 'Este campo es obligatorio',
            'amount.decimal' => 'Este campo debe ser un valor decimal con un máximo de 2 decimales',
            'amount.gt' => 'Este campo debe ser mayor a 0',
        ];
    }
}
