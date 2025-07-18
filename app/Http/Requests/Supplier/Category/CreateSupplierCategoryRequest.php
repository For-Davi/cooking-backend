<?php

namespace App\Http\Requests\Supplier\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do fornecedor é obrigatório',
            'name.string' => 'O nome deve ser um texto',
            'name.min' => 'O nome do fornecedor deve ter pelo menos 1 caractere',
            'name.max' => 'O nome do fornecedor não pode exceder 100 caracteres',
        ];
    }
}
