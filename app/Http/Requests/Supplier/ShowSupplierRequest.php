<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class ShowSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplierID' => 'required|exists:suppliers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'supplierID.required' => 'O ID do fornecedor é obrigatório',
            'supplierID.exists' => 'O ID do fornecedor informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
