<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class FilterEmployeeRequest extends FormRequest
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
            'sex' => 'nullable|string',
            'cpf' => 'nullable|numeric',
            'cnpj' => 'nullable|numeric',
            'active' => 'nullable|in:0,1',
            'hasLoginAccess' => 'nullable|in:0,1',
            'department' => 'nullable|exists:departments,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O nome deve ser uma string.',
            'email.string' => 'O e‑mail deve ser uma string.',
            'sex.string' => 'O sexo deve ser uma string.',
            'cpf.numeric' => 'O CPF deve conter apenas números.',
            'cnpj.numeric' => 'O CNPJ deve conter apenas números.',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo).',
            'hasLoginAccess.in' => 'O acesso de login deve ser 0 (inativo) ou 1 (ativo).',
            'country.string' => 'O país deve ser uma string.',
            'state.string' => 'O estado deve ser uma string.',
            'city.string' => 'A cidade deve ser uma string.',
            'department.exists' => 'O departamento selecionado não existe.',
        ];
    }
}
