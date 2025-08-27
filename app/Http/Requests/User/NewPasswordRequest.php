<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => 'required|string|min:8',
            'token' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'A senha é obrigatória',
            'password.string' => 'A senha deve ser uma string',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres',
            'token.required' => 'O e-mail é obrigatório',
            'token.string' => 'O e-mail deve ser uma string',
        ];
    }
}
