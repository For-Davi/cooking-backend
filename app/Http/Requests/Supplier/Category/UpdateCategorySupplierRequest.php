<?php

namespace App\Http\Requests\Supplier\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategorySupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:categories_supplier,id',
            'name' => 'required|string|min:1|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID da categoria é obrigatório',
            'id.exists' => 'O ID da categoria informado não existe.',
            'name.required' => 'O nome da categoria é obrigatório',
            'name.string' => 'O nome deve ser um texto',
            'name.min' => 'O nome da categoria deve ter pelo menos 1 caractere',
            'name.max' => 'O nome da categoria não pode exceder 100 caracteres',
        ];
    }
}
