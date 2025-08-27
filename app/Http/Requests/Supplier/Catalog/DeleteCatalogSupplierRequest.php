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
            'supplierID' => 'required|exists:supplier_catalog,supplier_id',
            'productVariantID' => 'required|exists:supplier_catalog,product_variant_id',
        ];
    }

    public function messages(): array
    {
        return [
            'supplierID.required' => 'O ID do fornecedor é obrigatório.',
            'supplierID.exists' => 'O ID do fornecedor informado não existe.',
            'productVariantID.required' => 'O ID do produto de catálogo é obrigatório.',
            'productVariantID.exists' => 'O do produto informado não existe.',
        ];
    }

    public function validationData()
    {
        return $this->route()->parameters();
    }
}
