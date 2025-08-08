<?php

namespace App\Http\Requests\Account\Type;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:transaction_categories,id',
            'name' => 'required|string|min:1|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do tipo é obrigatório.',
            'id.exists' => 'O ID do tipo informada não existe.',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome do tipo deve ter pelo menos 1 caractere',
            'name.max' => 'O nome do tipo não pode ter mais de 20 caracteres',
        ];
    }
}
