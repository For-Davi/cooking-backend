<?php

namespace App\Http\Requests\Supplier\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class ShowCatalogSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:catalog_supplier,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do item de catálogo é obrigatório',
            'id.exists' => 'O ID do item do catálogo informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
