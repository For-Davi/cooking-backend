<?php

namespace App\Http\Requests\Auth;

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
            'id' => 'required|string|max:100',
            'name' => 'required|string|min:3|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do departamento é obrigatório',
            'id.string' => 'O ID do departamento deve ser uma string',
            'id.max' => 'O ID do departamento não pode ter mais de 100 caracteres',
            'name.required' => 'O nome do departamento é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome do departamento não pode ter menos de 3 caracteres',
            'name.max' => 'O nome do departamento não pode ter mais de 50 caracteres',
        ];
    }
}
