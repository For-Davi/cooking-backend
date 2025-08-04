<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ShowProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'productID' => 'required|exists:products,id',
        ];
    }

    public function messages(): array
    {
        return [
            'productID.required' => 'O ID do produto é obrigatório',
            'productID.exists' => 'O ID do produto informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
