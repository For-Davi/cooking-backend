<?php

namespace App\Http\Requests\Movement;

use Illuminate\Foundation\Http\FormRequest;

class DeleteMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'movementID' => 'required|exists:movements,id',
        ];
    }

    public function messages(): array
    {
        return [
            'movementID.required' => 'O ID da movimentação é obrigatório.',
            'movementID.exists' => 'A movimentação informada não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
