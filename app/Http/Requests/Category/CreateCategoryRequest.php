<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name.required' => 'O nome da categoria é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome da categoria deve ter pelo menos 1 caractere',
            'name.max' => 'O nome da categoria não pode ter mais de 20 caracteres',
        ];
    }
}
