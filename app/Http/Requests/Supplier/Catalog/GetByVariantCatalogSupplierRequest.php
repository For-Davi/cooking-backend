<?php

namespace App\Http\Requests\Supplier\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class GetByVariantCatalogSupplierRequest extends FormRequest
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
            'variantID.required' => 'O ID da variante é obrigatório',
            'variantID.exists' => 'O ID da variante informada não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
