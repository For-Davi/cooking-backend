<?php

namespace App\Http\Requests\Revenue;

use Illuminate\Foundation\Http\FormRequest;

class ShowRevenueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:revenues,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID da receita é obrigatório.',
            'id.exists' => 'O ID da receita informada não existe.',
        ];
    }
}
