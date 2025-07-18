<?php

namespace App\Http\Requests\Product\Category;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoryID' => 'required|exists:product_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'categoryID.required' => 'O ID do categoria é obrigatório.',
            'categoryID.exists' => 'A categoria informada não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
