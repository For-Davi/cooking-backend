<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:suppliers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do fornecedor é obrigatório.',
            'id.exists' => 'O fornecedor informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
