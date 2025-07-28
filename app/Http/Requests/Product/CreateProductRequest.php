<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        if ($this->has('variants')) {
            $this->merge([
                'variants' => collect($this->input('variants', []))
                    ->map(fn ($v) => is_string($v) ? json_decode($v, true) : $v)
                    ->toArray(),
            ]);
        }

        if ($this->has('tags')) {
            $this->merge([
                'tags' => collect($this->input('tags', []))
                    ->map(fn ($t) => is_string($t) ? json_decode($t, true) : $t)
                    ->toArray(),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            // Regras para 'basic'
            'basic.name' => 'required|string|min:1|max:100',
            'basic.description' => 'nullable|string|max:500',
            'basic.type' => 'required|in:product,service',
            'basic.categoryID' => 'nullable|exists:product_categories,id',

            // Regras para 'variants' (array)
            'variants' => 'required|array|min:1',
            'variants.*.price' => 'required|numeric|min:0.01',
            'variants.*.cost' => 'required|numeric|min:0',
            'variants.*.stockQuantity' => 'required|integer|min:0',
            'variants.*.minStockAlert' => 'required|integer|min:0',
            'variants.*.sku' => 'nullable|string|max:50',
            'variants.*.active' => 'required|in:0,1',
            'variants.*.description' => 'nullable|string|max:500',
            'variants.*.gridItemID' => 'nullable|exists:grid_items,id',
            'variants.*.colors' => 'sometimes|array',
            'variants.*.colors.*.id' => 'required|exists:product_colors,id',

            // Regras para 'images'
            'images' => 'sometimes|array',
            'images.*' => 'file|mimes:jpg,jpeg,png,gif|max:3072', // 3MB

            // Regras para 'tags'
            'tags' => 'sometimes|array',
            'tags.*.id' => 'required|exists:tags,id',

            // Regras para 'advanced'
            'advanced.active' => 'required|in:0,1',
            'advanced.allowCoupon' => 'required|in:0,1',
            'advanced.allowDiscount' => 'required|in:0,1',
            'advanced.discountMaxPercentage' => 'required|numeric|min:0|max:100',
            'advanced.hasCommission' => 'required|in:0,1',
            'advanced.commissionPercentage' => 'required|numeric|min:0|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            // Mensagens para 'basic'
            'basic.name.required' => 'O nome do produto é obrigatório.',
            'basic.name.string' => 'O nome do produto deve ser um texto.',
            'basic.name.min' => 'O nome do produto deve ter pelo menos 1 caractere.',
            'basic.name.max' => 'O nome do produto não pode exceder 100 caracteres.',
            'basic.description.string' => 'A descrição deve ser um texto.',
            'basic.description.max' => 'A descrição não pode exceder 500 caracteres.',
            'basic.type.required' => 'O tipo do item é obrigatório (produto ou serviço).',
            'basic.type.in' => 'O tipo deve ser "product" (produto) ou "service" (serviço).',
            'basic.categoryID.exists' => 'A categoria selecionada é inválida.',

            // Mensagens para 'variants'
            'variants.required' => 'Pelo menos uma variante do produto é obrigatória.',
            'variants.min' => 'Pelo menos uma variante do produto é obrigatória.',
            'variants.*.price.required' => 'O preço da variante é obrigatório.',
            'variants.*.price.numeric' => 'O preço deve ser um valor numérico.',
            'variants.*.price.min' => 'O preço deve ser pelo menos 0.01.',
            'variants.*.cost.required' => 'O custo da variante é obrigatório.',
            'variants.*.cost.numeric' => 'O custo deve ser um valor numérico.',
            'variants.*.cost.min' => 'O custo não pode ser negativo.',
            'variants.*.stockQuantity.required' => 'A quantidade em estoque é obrigatória.',
            'variants.*.stockQuantity.integer' => 'A quantidade em estoque deve ser um número inteiro.',
            'variants.*.stockQuantity.min' => 'A quantidade em estoque não pode ser negativa.',
            'variants.*.minStockAlert.required' => 'O estoque mínimo é obrigatório.',
            'variants.*.minStockAlert.integer' => 'O estoque mínimo deve ser um número inteiro.',
            'variants.*.minStockAlert.min' => 'O estoque mínimo não pode ser negativo.',
            'variants.*.sku.max' => 'O SKU não pode exceder 50 caracteres.',
            'variants.*.active.required' => 'O status ativo/inativo é obrigatório.',
            'variants.*.active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo) para a variante',
            'variants.*.description.max' => 'A descrição da variante não pode exceder 500 caracteres.',
            'variants.*.gridItemID.exists' => 'O item de grade selecionado é inválido.',
            'variants.*.colors.*.id.required' => 'O ID da cor é obrigatório.',
            'variants.*.colors.*.id.exists' => 'A cor selecionada é inválida.',

            // Mensagens para 'images'
            'images.*.file' => 'O arquivo de imagem é inválido.',
            'images.*.mimes' => 'Apenas imagens JPG, JPEG, PNG ou GIF são permitidas.',
            'images.*.max' => 'O tamanho máximo da imagem é 3MB.',

            // Mensagens para 'tags'
            'tags.*.id.required' => 'O ID da tag é obrigatório.',
            'tags.*.id.exists' => 'A tag selecionada é inválida.',

            // Mensagens para 'advanced'
            'advanced.active.required' => 'O status ativo/inativo é obrigatório.',
            'advanced.active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo) para o produto',
            'advanced.allowCoupon.required' => 'A permissão para cupons é obrigatória.',
            'advanced.allowCoupon.in' => 'O status ativo deve ser 0 (não) ou 1 (sim) para a permissão de cupom',
            'advanced.allowDiscount.required' => 'A permissão para descontos é obrigatória.',
            'advanced.allowDiscount.in' => 'O status ativo deve ser 0 (não) ou 1 (sim) para a permissão de desconto',
            'advanced.discountMaxPercentage.required' => 'A porcentagem máxima de desconto é obrigatória.',
            'advanced.discountMaxPercentage.numeric' => 'A porcentagem máxima de desconto deve ser um número.',
            'advanced.discountMaxPercentage.min' => 'A porcentagem máxima de desconto não pode ser negativa.',
            'advanced.discountMaxPercentage.max' => 'A porcentagem máxima de desconto não pode exceder 100%.',
            'advanced.hasCommission.required' => 'A informação sobre comissão é obrigatória.',
            'advanced.hasCommission.in' => 'O status ativo deve ser 0 (não) ou 1 (sim) para a comissão',
            'advanced.commissionPercentage.required' => 'A porcentagem de comissão é obrigatória.',
            'advanced.commissionPercentage.numeric' => 'A porcentagem de comissão deve ser um número.',
            'advanced.commissionPercentage.min' => 'A porcentagem de comissão não pode ser negativa.',
            'advanced.commissionPercentage.max' => 'A porcentagem de comissão não pode exceder 100%.',
        ];
    }
}
