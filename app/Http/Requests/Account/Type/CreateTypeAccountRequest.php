<?php

namespace App\Http\Requests\Account\Type;

use Illuminate\Foundation\Http\FormRequest;

class CreateTypeAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do tipo é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome do tipo deve ter pelo menos 1 caractere',
            'name.max' => 'O nome do tipo não pode ter mais de 20 caracteres',
        ];
    }
}
