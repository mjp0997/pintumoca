<?php

namespace App\Http\Requests;

use Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'role_id' => 'required|integer|exists:roles,id',
            'office_id' => [
                'nullable',
                Rule::requiredIf(!Helper::is_admin_role($this->input('role_id'))),
                Rule::excludeIf(Helper::is_admin_role($this->input('role_id'))),
                'integer', 'exists:offices,id'],
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('id'))],
            'password' => [
                'nullable',
                Rule::requiredIf(!$this->route('id')),
                'string', 'min:8'
            ]
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'Este campo es obligatorio',
            'role_id.integer' => 'Este campo debe ser un valor entero',
            'role_id.exists' => 'El valor seleccionado no se encuentra en la base de datos',
            'office_id.required' => 'Este campo es obligatorio',
            'office_id.integer' => 'Este campo debe ser un valor entero',
            'office_id.exists' => 'El valor seleccionado no se encuentra en la base de datos',
            'name.required' => 'Este campo es obligatorio',
            'name.string' => 'Este campo debe ser un valor string',
            'email.required' => 'Este campo es obligatorio',
            'email.email' => 'Este campo debe ser un correo válido',
            'email.unique' => 'Este correo ya existe en la base de datos',
            'password.required' => 'Este campo es obligatorio',
            'password.string' => 'Este campo debe ser un valor string',
            'password.min' => 'La contraseña debe contener al menos 8 caracteres',
        ];
    }
}
