<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'password' => 'required',
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email is required, test',
            'email.email' => 'The email must be valid',
            'password.required' => 'The password is required',
            'name.required' => 'The name is required'
        ];
    }
}