<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'value' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'value.required' => 'O campo de pesquisa é obrigatório.',
            'value.string' => 'O campo de pesquisa deve conter um texto válido.',
            'value.max' => 'O campo de pesquisa pode ter no máximo 500 caracteres.',
        ];
    }
}
