<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class DeleteEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employeeID' => 'required|exists:employees,id',
        ];
    }

    public function messages(): array
    {
        return [
            'employeeID.required' => 'O ID do funcionário é obrigatório.',
            'employeeID.exists' => 'O funcionário informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
