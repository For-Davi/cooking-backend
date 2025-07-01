<?php

namespace App\Http\Requests\Grid\Item;

use Illuminate\Foundation\Http\FormRequest;

class CreateGridItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gridGroupID' => 'required|exists:grid_groups,id',
            'size' => 'required|string',
            'order' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'gridGroupID.required' => 'O ID da grade é obrigatório',
            'gridGroupID.exists' => 'O ID da grade informada não existe.',
            'size.required' => 'O tamanho do item é obrigatório',
            'size.string' => 'O tamanho do item deve ser um texto',
            'order.required' => 'A ordem do item é obrigatória',
            'order.integer' => 'A ordem do item deve ser um número inteiro',
        ];
    }
}
