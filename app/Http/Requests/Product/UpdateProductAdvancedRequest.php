<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductAdvancedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'productID' => 'required|exists:products,id',
            'active' => 'required|in:0,1',
            'allowCoupon' => 'required|in:0,1',
            'allowDiscount' => 'required|in:0,1',
            'discountMaxPercentage' => 'required|numeric|min:0|max:100',
            'hasCommission' => 'required|in:0,1',
            'commissionPercentage' => 'required|numeric|min:0|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'productID.required' => 'O ID do produto é obrigatório',
            'productID.exists' => 'O ID do produto informado não existe.',
            'active.required' => 'O status ativo/inativo é obrigatório.',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo) para o produto',
            'allowCoupon.required' => 'A permissão para cupons é obrigatória.',
            'allowCoupon.in' => 'O status ativo deve ser 0 (não) ou 1 (sim) para a permissão de cupom',
            'allowDiscount.required' => 'A permissão para descontos é obrigatória.',
            'allowDiscount.in' => 'O status ativo deve ser 0 (não) ou 1 (sim) para a permissão de desconto',
            'discountMaxPercentage.required' => 'A porcentagem máxima de desconto é obrigatória.',
            'discountMaxPercentage.numeric' => 'A porcentagem máxima de desconto deve ser um número.',
            'discountMaxPercentage.min' => 'A porcentagem máxima de desconto não pode ser negativa.',
            'discountMaxPercentage.max' => 'A porcentagem máxima de desconto não pode exceder 100%.',
            'hasCommission.required' => 'A informação sobre comissão é obrigatória.',
            'hasCommission.in' => 'O status ativo deve ser 0 (não) ou 1 (sim) para a comissão',
            'commissionPercentage.required' => 'A porcentagem de comissão é obrigatória.',
            'commissionPercentage.numeric' => 'A porcentagem de comissão deve ser um número.',
            'commissionPercentage.min' => 'A porcentagem de comissão não pode ser negativa.',
            'commissionPercentage.max' => 'A porcentagem de comissão não pode exceder 100%.',
        ];
    }
}
