<?php

namespace App\Http\Requests\Supplier\Catalog;

use App\Enums\SupplierType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateCatalogSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:100',
            'type' => ['nullable', new Enum(SupplierType::class)],
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do fornecedor é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',
            'name.min' => 'O nome deve ter pelo menos 1 caractere.',
            'name.max' => 'O nome não pode exceder 100 caracteres.',
            'type.enum' => 'O tipo selecionado é inválido.',
            'supplier_id.required' => 'O fornecedor é obrigatório.',
            'supplier_id.integer' => 'O ID do fornecedor deve ser um número inteiro.',
            'supplier_id.exists' => 'O fornecedor selecionado não existe.',
            'description.string' => 'A descrição deve ser um texto.',
        ];
    }
}
