<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'name' => [
                'required',
            ],
            'code' => [
                'required',
                Rule::unique('offices', 'name')->ignore($this?->route('id'))
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este campo es obligatorio',
            'code.required' => 'Este campo es obligatorio',
            'code.unique' => 'El valor ingresado ya se encuentra en uso'
        ];
    }
}
