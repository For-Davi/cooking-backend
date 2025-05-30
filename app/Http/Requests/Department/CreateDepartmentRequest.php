<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do departamento é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome do departamento não pode ter menos de 1 caracteres',
            'name.max' => 'O nome da departamento não pode ter mais de 50 caracteres',
        ];
    }
}
