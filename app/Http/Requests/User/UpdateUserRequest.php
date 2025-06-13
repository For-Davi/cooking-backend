<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userId' => 'required|exists:users,id',
            'name' => 'required|string|min:3|max:30',
            'email' => 'required|string|email|max:50|unique:users,email,'.$this->id,
            'active' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'userId.required' => 'O ID do usuário é obrigatório',
            'userId.exists' => 'O ID do usuário informado não existe.',
            'name.required' => 'O nome é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome não pode ter menos de 3 caracteres',
            'name.max' => 'O nome não pode ter mais de 30 caracteres',
            'email.required' => 'O e-mail é obrigatório',
            'email.string' => 'O e-mail deve ser uma string',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido',
            'email.max' => 'O e-mail não pode ter mais de 50 caracteres',
            'email.unique' => 'Este e-mail já está registrado',
            'active.required' => 'O status ativo/inativo é obrigatório',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo)',
        ];
    }
}
