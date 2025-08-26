<?php

namespace App\Http\Requests\Supplier\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class CreateCatalogSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'price' => 'required|numeric|min:0',
            'productVariantID' => 'required|integer|exists:product_variants,id',
            'supplierID' => 'required|integer|exists:suppliers,id',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'price.required' => 'O preço do produto é obrigatório.',
            'price.string' => 'O preço deve ser um número.',
            'price.min' => 'O preço não deve ser negativo.',
            'productVariantID.required' => 'O ID da variante do produto é obrigatório.',
            'productVariantID.integer' => 'O ID da variante do produto deve ser um número inteiro.',
            'productVariantID.exists' => 'A variante do produto não existe.',
            'supplierID.required' => 'O fornecedor é obrigatório.',
            'supplierID.integer' => 'O ID do fornecedor deve ser um número inteiro.',
            'supplierID.exists' => 'O fornecedor selecionado não existe.',
            'description.string' => 'A descrição deve ser um texto.',
        ];
    }
}
