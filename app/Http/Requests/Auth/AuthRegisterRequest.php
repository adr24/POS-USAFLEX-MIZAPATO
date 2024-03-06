<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|min:4",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|max:18",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El nombre es muy corto",
            "email.required" => "El campo email es requerido",
            "email.email" => "Ingrese un correo valido",
            "email.unique" => "Ya se registro un usuario con este correo",
            "password.required" => "El campo password es requerido",
            "password.min" => "La contraseña es muy corta",
            "password.max" => "La contraseña es muy larga",
        ];
    }
}
