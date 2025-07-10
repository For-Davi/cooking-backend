<?php

namespace App\Http\Requests\Grid\Group;

use Illuminate\Foundation\Http\FormRequest;

class CreateGridGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gridName' => 'required|string|min:2|max:20',
            'itens' => 'required|array|min:1',
            'itens.*.size' => 'required|string',
            'itens.*.order' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'gridName.required' => 'O nome do grupo de tamanhos é obrigatório',
            'gridName.string' => 'O nome do grupo de tamanhos deve ser uma string',
            'gridName.min' => 'O nome do grupo de tamanhos não pode ter menos de 1 caractere',
            'gridName.max' => 'O nome do grupo de tamanhos não pode ter mais de 20 caracteres',
            'itens.required' => 'É necessário pelo menos um item no grupo',
            'itens.array' => 'Os itens devem ser enviados como uma lista',
            'itens.min' => 'Deve haver pelo menos um item no grupo',
            'itens.*.size.required' => 'O tamanho do item é obrigatório',
            'itens.*.size.string' => 'O tamanho do item deve ser um texto',
            'itens.*.order.required' => 'A ordem do item é obrigatória',
            'itens.*.order.integer' => 'A ordem do item deve ser um número inteiro',
            'itens.*.order.min' => 'A ordem do item não pode ser negativa',
        ];
    }
}
