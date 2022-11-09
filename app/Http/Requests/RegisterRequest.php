<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'name.required' => 'El campo de nombre es obligatorio.',
            'password_confirm.required' => 'El campo de confirmación de contraseña es obligatorio',
            'password_confirm.confirm' => 'La confirmación de la contraseña y la contraseña deben coincidir.'

        ];
    }
}