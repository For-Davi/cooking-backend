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
            'gridName' => 'required|string|min:2|max:15',
            'items' => 'required|array|min:1',
            'items.*.size' => 'required|string',
            'items.*.order' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'gridName.required' => 'O nome do grupo de tamanhos é obrigatório',
            'gridName.string' => 'O nome do grupo de tamanhos deve ser uma string',
            'gridName.min' => 'O nome do grupo de tamanhos não pode ter menos de 2 caractéres',
            'gridName.max' => 'O nome do grupo de tamanhos não pode ter mais de 15 caractéres',
            'items.required' => 'É necessário pelo menos um item no grupo',
            'items.array' => 'Os itens devem ser enviados como uma lista',
            'items.min' => 'Deve haver pelo menos um item no grupo',
            'items.*.size.required' => 'O tamanho do item é obrigatório',
            'items.*.size.string' => 'O tamanho do item deve ser um texto',
            'items.*.order.required' => 'A ordem do item é obrigatória',
            'items.*.order.integer' => 'A ordem do item deve ser um número inteiro',
            'items.*.order.min' => 'A ordem do item não pode ser negativa',
        ];
    }
}
