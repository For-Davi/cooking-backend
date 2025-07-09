<?php

namespace App\Http\Requests\ProductColor;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductColorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:20',
            'hexColorCode' => 'nullable|string|min:7|max:7',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da cor é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome da cor não pode ter menos de 1 caracteres',
            'name.max' => 'O nome da cor não pode ter mais de 20 caracteres',
            'hexColorCode.string' => 'O código da cor deve ser uma string',
            'hexColorCode.min' => 'O código da cor deve ter 7 caracteres',
            'hexColorCode.max' => 'O código da cor deve ter 7 caracteres',
        ];
    }
}
