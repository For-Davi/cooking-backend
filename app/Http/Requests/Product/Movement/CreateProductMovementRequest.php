<?php

namespace App\Http\Requests\Product\Movement;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reason' => 'required|string|in:buy,sell,return,loss,inventory,transfer,adjustment',
            'type' => 'required|in:in,out,adjustment',
            'documentNumber' => 'nullable|string|max:255',
            'lotNumber' => 'nullable|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'previousStock' => 'required|numeric|min:0',
            'newStock' => 'required|numeric|min:0',
            'unitCost' => 'nullable|numeric|min:0',
            'totalCost' => 'nullable|numeric|min:0',
            'productVariantID' => 'required|exists:product_variants,id',
            'supplierID' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'reason.required' => 'O motivo do movimento é obrigatório.',
            'reason.in' => 'O motivo informado não é válido.',

            'type.required' => 'O tipo do movimento é obrigatório.',
            'type.in' => 'O tipo deve ser entrada (in), saída (out) ou ajuste (adjustment).',

            'documentNumber.string' => 'O número do documento deve ser um texto válido.',
            'documentNumber.max' => 'O número do documento não pode ultrapassar 255 caracteres.',

            'lotNumber.string' => 'O número do lote deve ser um texto válido.',
            'lotNumber.max' => 'O número do lote não pode ultrapassar 255 caracteres.',

            'quantity.required' => 'A quantidade é obrigatória.',
            'quantity.numeric' => 'A quantidade deve ser numérica.',
            'quantity.min' => 'A quantidade não pode ser negativa.',

            'previousStock.required' => 'O estoque anterior é obrigatório.',
            'previousStock.numeric' => 'O estoque anterior deve ser numérico.',
            'previousStock.min' => 'O estoque anterior não pode ser negativo.',

            'newStock.required' => 'O novo estoque é obrigatório.',
            'newStock.numeric' => 'O novo estoque deve ser numérico.',
            'newStock.min' => 'O novo estoque não pode ser negativo.',

            'unitCost.numeric' => 'O custo unitário deve ser numérico.',
            'unitCost.min' => 'O custo unitário não pode ser negativo.',

            'totalCost.numeric' => 'O custo total deve ser numérico.',
            'totalCost.min' => 'O custo total não pode ser negativo.',

            'productVariantID.required' => 'O produto é obrigatório.',
            'productVariantID.exists' => 'O produto informado não existe.',

            'supplierID.exists' => 'O fornecedor informado não existe.',

            'description.string' => 'A descrição deve ser um texto válido.',
        ];
    }
}
