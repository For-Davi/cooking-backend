<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CheckIDEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employeeId' => 'required|exists:employees,id',
        ];
    }

    public function messages(): array
    {
        return [
            'employeeId.required' => 'O ID do funcionário é obrigatório.',
            'employeeId.exists' => 'O funcionário informado não existe.',
        ];
    }
}
