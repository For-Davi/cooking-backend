<?php

namespace App\Http\Requests\Product\Variant;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'variantID' => 'required|exists:product_variants,id',
        ];
    }

    public function messages(): array
    {
        return [
            'variantID.required' => 'O ID da variante é obrigatória.',
            'variantID.exists' => 'A variante informada não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
