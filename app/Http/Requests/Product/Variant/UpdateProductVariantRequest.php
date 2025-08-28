<?php

namespace App\Http\Requests\Product\Variant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:product_variants,id',
            'price' => 'required|numeric|min:0.01',
            'cost' => 'required|numeric|min:0',
            'minStockAlert' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:50',
            'code' => 'nullable|string|max:50',
            'active' => 'required|in:0,1',
            'description' => 'nullable|string|max:500',
            'colorID' => 'nullable|exists:product_colors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID da variante do produto é obrigatório.',
            'id.exists' => 'A variante do produto selecionada não existe.',
            'price.required' => 'O preço é obrigatório.',
            'price.numeric' => 'O preço deve ser um valor numérico.',
            'price.min' => 'O preço deve ser no mínimo 0.01.',
            'cost.required' => 'O custo é obrigatório.',
            'cost.numeric' => 'O custo deve ser um valor numérico.',
            'cost.min' => 'O custo não pode ser negativo.',
            'minStockAlert.required' => 'O alerta de estoque mínimo é obrigatório.',
            'minStockAlert.integer' => 'O alerta de estoque mínimo deve ser um número inteiro.',
            'minStockAlert.min' => 'O alerta de estoque mínimo não pode ser negativo.',
            'sku.string' => 'O SKU deve ser uma string.',
            'sku.max' => 'O SKU não pode ter mais de 50 caracteres.',
            'code.string' => 'O código deve ser uma string.',
            'code.max' => 'O código não pode ter mais de 50 caracteres.',
            'active.required' => 'O status ativo é obrigatório.',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo).',
            'description.string' => 'A descrição deve ser um texto.',
            'description.max' => 'A descrição não pode ter mais de 500 caracteres.',
            'colorID.exists' => 'A cor selecionada não existe.',
        ];
    }
}
