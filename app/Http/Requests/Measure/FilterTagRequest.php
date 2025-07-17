<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class FilterTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'active' => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O nome deve ser uma string.',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo).',
        ];
    }
}
