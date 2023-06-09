<?php

namespace App\Http\Requests;

use App\Rules\EnoughStock;
use Illuminate\Foundation\Http\FormRequest;

class SingleProcedureRequest extends FormRequest
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
            'from_office_id' => [
                'required', 'integer', 'exists:offices,id'
            ],
            'to_office_id' => [
                'required', 'integer', 'exists:offices,id', 'different:from_office_id'
            ],
            'product_id' => [
                'required', 'integer', 'exists:products,id'
            ],
            'quantity' => [
                'bail', 'required', 'integer', 'gt:0', new EnoughStock()
            ],
        ];
    }

    public function messages()
    {
        return [
            'from_office_id.required' => 'Este campo es obligatorio',
            'from_office_id.integer' => 'Este campo debe ser un valor entero',
            'from_office_id.exists' => 'El valor ingresado no se encuentra en la base de datos',
            'to_office_id.required' => 'Este campo es obligatorio',
            'to_office_id.integer' => 'Este campo debe ser un valor entero',
            'to_office_id.exists' => 'El valor ingresado no se encuentra en la base de datos',
            'to_office_id.different' => 'La sucursal de destino no puede ser igual que la de origen',
            'product_id.required' => 'Este campo es obligatorio',
            'product_id.integer' => 'Este campo debe ser un valor entero',
            'product_id.exists' => 'El valor ingresado no se encuentra en la base de datos',
            'quantity.required' => 'Este campo es obligatorio',
            'quantity.integer' => 'Este campo debe ser un valor entero',
            'quantity.gt' => 'El valor ingresado debe ser mayor a 0',
        ];
    }
}
