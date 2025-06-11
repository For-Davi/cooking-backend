<?php

namespace App\Http\Requests\Supplier\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCatalogSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:catalog_supplier,id',
            'name' => 'required|string|min:1|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do item do catálogo é obrigatório',
            'id.exists' => 'O ID do item do catálogo informado não existe.',
            'name.required' => 'O nome do item do catálogo é obrigatório',
            'name.string' => 'O nome do item do catálogo deve ser um texto',
            'name.min' => 'O nome do item do catálogo categoria deve ter pelo menos 1 caractere',
            'name.max' => 'O nome do item do catálogo categoria não pode exceder 100 caracteres',
        ];
    }
}
