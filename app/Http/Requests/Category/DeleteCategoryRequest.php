<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoryID' => 'required|exists:categories,id',
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
