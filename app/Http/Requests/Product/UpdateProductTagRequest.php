<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'tags' => 'sometimes|array',
            'tags.*.id' => 'required|exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'O ID do produto é obrigatório',
            'product_id.exists' => 'O ID do produto informado não existe.',
            'tags.*.id.required' => 'O ID da tag é obrigatório.',
            'tags.*.id.exists' => 'A tag selecionada é inválida.',
        ];
    }
}
