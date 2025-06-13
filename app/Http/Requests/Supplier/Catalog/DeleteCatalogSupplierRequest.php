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
            'catalogId' => 'required|exists:catalog_supplier,id',
        ];
    }

    public function messages(): array
    {
        return [
            'catalogId.required' => 'O ID do item de catálogo é obrigatório.',
            'catalogId.exists' => 'O item informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
