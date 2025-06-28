<?php

namespace App\Http\Requests\Employee\Action;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccessLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'id' => 'required|exists:employees,id',
            'roleId' => 'required|exists:roles,id',
            'departmentId' => 'required|exists:departments,id',
            'password' => 'required|string|min:8',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do funcionário é obrigatório',
            'id.exists' => 'O ID do funcionário informado não existe.',
            'roleId.required' => 'O perfil de acesso é obrigatório.',
            'roleId.exists' => 'A permissão selecionado é inválida.',
            'departmentId.required' => 'O ID do departamento é obrigatório.',
            'departmentId.exists' => 'O ID do departamento informado não existe.',
            'password.required' => 'A senha é obrigatória',
            'password.string' => 'A senha deve ser uma string',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres',
        ];
    }
}
