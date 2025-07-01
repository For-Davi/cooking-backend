<?php

namespace App\Http\Requests\Grid\Group;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGridGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:grid_groups,id',
            'name' => 'required|string|min:1|max:20',
            'itens' => 'required|array',
            'itens.*.id' => 'required|exists:grid_itens,id',
            'itens.*.size' => 'required|string',
            'itens.*.order' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID da grade é obrigatório',
            'id.exists' => 'O ID da grade informada não existe.',
            'name.required' => 'O nome do grupo de tamanhos é obrigatório',
            'name.string' => 'O nome do grupo de tamanhos deve ser uma string',
            'name.min' => 'O nome do grupo de tamanhos não pode ter menos de 1 caractere',
            'name.max' => 'O nome do grupo de tamanhos não pode ter mais de 20 caracteres',
            'itens.required' => 'É necessário pelo menos um item no grupo',
            'itens.array' => 'Os itens devem ser enviados como uma lista',
            'itens.*.id.required' => 'O ID do item é obrigatório',
            'itens.*.id.exists' => 'O ID do item informado não existe.',
            'itens.*.size.required' => 'O tamanho do item é obrigatório',
            'itens.*.size.string' => 'O tamanho do item deve ser um texto',
            'itens.*.order.required' => 'A ordem do item é obrigatória',
            'itens.*.order.integer' => 'A ordem do item deve ser um número inteiro',
            'itens.*.order.min' => 'A ordem do item não pode ser negativa',
        ];
    }
}
