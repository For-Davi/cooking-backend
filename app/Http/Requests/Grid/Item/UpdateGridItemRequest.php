<?php

namespace App\Http\Requests\Grid\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGridItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:grid_itens,id',
            'size' => 'required|string',
            'order' => 'required|integer|min:0',
            'active' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do item da grade é obrigatório.',
            'id.exists' => 'O ID do item da grade informado não existe.',
            'size.required' => 'O tamanho do item é obrigatório',
            'size.string' => 'O tamanho do item deve ser um texto',
            'order.required' => 'A ordem do item é obrigatória',
            'order.integer' => 'A ordem do item deve ser um número inteiro',
            'active.required' => 'O status ativo/inativo é obrigatório',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo)',
        ];
    }
}
