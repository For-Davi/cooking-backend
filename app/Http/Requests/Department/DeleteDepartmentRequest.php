<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'departmentID' => 'required|exists:departments,id',
        ];
    }

    public function messages(): array
    {
        return [
            'departmentID.required' => 'O ID do departamento é obrigatório.',
            'departmentID.exists' => 'O departamento informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
