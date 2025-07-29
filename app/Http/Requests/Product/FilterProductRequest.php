<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class FilterProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'sku' => 'nullable|string',
            'stockCritical' => 'nullable|in:0,1',
            'active' => 'nullable|in:0,1',
            'category' => 'nullable|exists:product_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O nome deve ser um texto válido.',
            'sku.string' => 'O SKU deve ser um texto válido.',
            'stockCritical.in' => 'O estoque crítico deve ser 0 (não) ou 1 (sim).',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo).',
            'category.exists' => 'A categoria selecionada não existe.',
        ];
    }
}
