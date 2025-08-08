<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Deve ser informado a senha atual',
            'current_password.string' => 'A senha atual deve ser uma string',
            'current_password.min' => 'A senha atual não pode ter menos de 8 caracteres',
            'new_password.required' => 'Deve ser informado a nova senha',
            'new_password.string' => 'A nova senha deve ser uma string',
            'new_password.min' => 'A nova senha não pode ter menos de 8 caracteres',
        ];
    }
}
