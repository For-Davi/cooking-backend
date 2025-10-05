<?php

namespace App\Http\Requests\Revenue;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRevenueFavoriteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:revenues,id',
            'favorite' => 'required|numeric|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID da receita é obrigatório.',
            'id.exists' => 'A receita informada não existe.',
            'favorite.required' => 'O campo favorito é obrigatório.',
            'favorite.numeric' => 'O campo favorito deve ser um número.',
            'favorite.in' => 'O campo favorito deve ser 0 ou 1.',
        ];
    }
}
