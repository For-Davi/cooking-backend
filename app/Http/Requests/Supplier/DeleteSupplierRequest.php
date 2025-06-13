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
            'supplierId' => 'required|exists:suppliers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'supplierId.required' => 'O ID do fornecedor é obrigatório.',
            'supplierId.exists' => 'O fornecedor informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
