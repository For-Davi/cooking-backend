<?php

namespace App\Http\Requests\Product\Color;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductColorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'colorID' => 'required|exists:product_colors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'colorID.required' => 'O ID da cor é obrigatório.',
            'colorID.exists' => 'A cor informada não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
