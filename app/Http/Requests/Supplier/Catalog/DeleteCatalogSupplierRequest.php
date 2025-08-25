<?php

namespace App\Http\Requests\Supplier\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCatalogSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'catalogID' => 'required|exists:supplier_catalog,supplier_id',
            'productVariantID' => 'required|exists:supplier_catalog,product_variant_id',
        ];
    }

    public function messages(): array
    {
        return [
            'catalogID.required' => 'O ID do item de catálogo é obrigatório.',
            'catalogID.exists' => 'O item informado não existe.',
             'productVariantID.required' => 'O ID do produto de catálogo é obrigatório.',
            'productVariantID.exists' => 'O do produto informado não existe.',
        ];
    }

   public function validationData()
{
    return $this->route()->parameters(); 
}
}
