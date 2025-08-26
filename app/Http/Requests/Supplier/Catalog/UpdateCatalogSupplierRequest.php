<?php

namespace App\Http\Requests\Supplier\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCatalogSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplierID' => 'required|integer|exists:supplier_catalog,supplier_id',
            'productVariantID' => 'required|integer|exists:supplier_catalog,product_variant_id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'supplierID.required' => 'O ID do fornecedor do catálogo é obrigatório',
            'supplierID.integer' => 'O ID do fornecedor deve ser um número inteiro.',
            'supplierID.exists' => 'O ID do fornecedor informado não existe.',
            'productVariantID.required' => 'O ID do fornecedor catálogo é obrigatório',
            'productVariantID.integer' => 'O ID da variante do produto deve ser um número inteiro.',
            'productVariantID.exists' => 'O ID do fornecedor informado não existe.',
            'price.required' => 'O preço do produto é obrigatório.',
            'price.string' => 'O preço deve ser um número.',
            'price.min' => 'O preço não deve ser negativo.',
            'description.string' => 'A descrição deve ser um texto.',
        ];
    }
}
