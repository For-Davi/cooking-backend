<?php

namespace App\Http\Requests\ProductColor;

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
        ];
    }
}
