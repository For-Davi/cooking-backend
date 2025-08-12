<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductBasicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'productID' => 'required|exists:products,id',
            'name' => 'required|string|min:1|max:100',
            'description' => 'nullable|string|max:500',
            'type' => 'required|in:product,service',
            'category' => 'nullable|exists:product_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'productID.required' => 'O ID do produto é obrigatório',
            'productID.exists' => 'O ID do produto informado não existe.',
            'name.required' => 'O nome do produto é obrigatório.',
            'name.string' => 'O nome do produto deve ser um texto.',
            'name.min' => 'O nome do produto deve ter pelo menos 1 caractere.',
            'name.max' => 'O nome do produto não pode exceder 100 caracteres.',
            'description.string' => 'A descrição deve ser um texto.',
            'description.max' => 'A descrição não pode exceder 500 caracteres.',
            'type.required' => 'O tipo do item é obrigatório (produto ou serviço).',
            'type.in' => 'O tipo deve ser "product" (produto) ou "service" (serviço).',
            'category.exists' => 'A categoria selecionada é inválida.',
        ];
    }
}
