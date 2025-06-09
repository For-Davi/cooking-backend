<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:departments,id',
            'name' => 'required|string|min:3|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do departamento é obrigatório.',
            'id.exists' => 'O ID do departamento informado não existe.',
            'name.required' => 'O nome do departamento é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome do departamento não pode ter menos de 3 caracteres',
            'name.max' => 'O nome do departamento não pode ter mais de 50 caracteres',
        ];
    }
}
