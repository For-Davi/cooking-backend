<?php

namespace App\Http\Requests\Supplier\Category;

use Illuminate\Foundation\Http\FormRequest;

class ShowCategorySupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoryId' => 'required|exists:categories_supplier,id',
        ];
    }

    public function messages(): array
    {
        return [
            'categoryId.required' => 'O ID da categoria é obrigatório',
            'categoryId.exists' => 'O ID da categoria informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
