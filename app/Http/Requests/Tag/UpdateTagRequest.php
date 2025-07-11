<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:tags,id',
            'name' => 'required|string|min:1|max:20',
            'active' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID da tag é obrigatório',
            'id.exists' => 'O ID da tag informada não existe',
            'name.required' => 'O nome da tag é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome da tag não pode ter menos de 1 caracteres',
            'name.max' => 'O nome da tag não pode ter mais de 20 caracteres',
            'active.required' => 'O status ativo/inativo é obrigatório',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo)',
        ];
    }
}
