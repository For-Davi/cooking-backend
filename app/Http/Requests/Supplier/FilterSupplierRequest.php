<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class FilterSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'email' => 'nullable|string',
            'cpf' => 'nullable|numeric',
            'cnpj' => 'nullable|numeric',
            'active' => 'nullable|in:0,1',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'category' => 'nullable|exists:categories_supplier,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O nome deve ser uma string.',
            'email.string' => 'O e‑mail deve ser uma string.',
            'cpf.numeric' => 'O CPF deve conter apenas números.',
            'cnpj.numeric' => 'O CNPJ deve conter apenas números.',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo).',
            'country.string' => 'O país deve ser uma string.',
            'state.string' => 'O estado deve ser uma string.',
            'city.string' => 'A cidade deve ser uma string.',
            'category.exists' => 'A categoria selecionada não existe.',
        ];
    }
}
