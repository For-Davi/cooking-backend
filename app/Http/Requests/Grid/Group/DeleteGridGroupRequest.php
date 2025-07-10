<?php

namespace App\Http\Requests\Grid\Group;

use Illuminate\Foundation\Http\FormRequest;

class DeleteGridGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gridID' => 'required|exists:grid_groups,id',
        ];
    }

    public function messages(): array
    {
        return [
            'gridID.required' => 'O ID do grupo de tamanhos é obrigatório.',
            'gridID.exists' => 'O grupo de tamanhos informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
