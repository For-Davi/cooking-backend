<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FilterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'email' => 'nullable|string',
            'active' => 'nullable|in:0,1',
            'department' => 'nullable|integer|exists:departments,id',
            'role' => 'nullable|integer|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O nome deve ser uma string',
            'email.string' => 'O e-mail deve ser uma string',
            'active.in' => 'O campo ativo deve ser 0 (inativo) ou 1 (ativo)',
            'department.integer' => 'O departamento deve ser um número',
            'department.exists' => 'O departamento selecionado é inválido',
            'role.integer' => 'O cargo deve ser um número',
            'role.exists' => 'O cargo selecionado é inválido',
        ];
    }
}
