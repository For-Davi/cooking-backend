<?php

namespace App\Http\Requests\Transaction\Category;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTransactionCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoryID' => 'required|exists:transaction_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'categoryID.required' => 'O ID da categoria é obrigatório.',
            'categoryID.exists' => 'O ID da categoria informada não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
