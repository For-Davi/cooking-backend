<?php

namespace App\Http\Requests\Product\Color;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductColorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:product_colors,id',
            'name' => 'required|string|min:3|max:20',
            'hexColorCode' => 'nullable|string|min:7|max:7',
            'active' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID da cor é obrigatório.',
            'id.exists' => 'O ID da cor informada não existe.',
            'name.required' => 'O nome da cor é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome da cor não pode ter menos de 3 caracteres',
            'name.max' => 'O nome da cor não pode ter mais de 20 caracteres',
            'hexColorCode.string' => 'O código da cor deve ser uma string',
            'hexColorCode.min' => 'O código da cor deve ter 7 caracteres',
            'hexColorCode.max' => 'O código da cor deve ter 7 caracteres',
            'active.required' => 'O status ativo/inativo é obrigatório',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo)',
        ];
    }
}
