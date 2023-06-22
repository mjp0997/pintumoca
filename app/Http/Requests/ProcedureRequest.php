<?php

namespace App\Http\Requests;

use App\Rules\EnoughStock;
use Illuminate\Foundation\Http\FormRequest;

class ProcedureRequest extends FormRequest
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
            'date' => [
                'nullable', 'date', 'date_format:Y-m-d'
            ],
            'products' => [
                'required', 'array', 'min:1'
            ],
            'products.*.product_id' => [
                'required', 'integer', 'exists:products,id'
            ],
            'products.*.quantity' => [
                'bail', 'required', 'integer', 'gt:0', new EnoughStock()
            ],

            'single' => 'nullable|boolean'
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
            'date.date' => 'Este campo debe ser una fecha válida',
            'date.date_format' => 'Este campo debe tener un formato Y-m-d',

            'products.required' => 'Este campo es obligatorio',
            'products.array' => 'Este campo debe ser un valor array',
            'products.min' => 'Debe agregar al menos un producto',
            'products.*.product_id.required' => 'Este campo es obligatorio',
            'products.*.product_id.integer' => 'Este campo debe ser un valor entero',
            'products.*.product_id.exists' => 'El valor ingresado no se encuentra en la base de datos',
            'products.*.quantity.required' => 'Este campo es obligatorio',
            'products.*.quantity.integer' => 'Este campo debe ser un valor entero',
            'products.*.quantity.gt' => 'El valor ingresado debe ser mayor a 0',
        ];
    }
}
