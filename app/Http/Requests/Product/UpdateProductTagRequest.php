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
            'productID' => 'required|exists:products,id',
            'tags' => 'sometimes|array',
            'tags.*.id' => 'required|exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [
            'productID.required' => 'O ID do produto é obrigatório',
            'productID.exists' => 'O ID do produto informado não existe.',
            'tags.*.id.required' => 'O ID da tag é obrigatório.',
            'tags.*.id.exists' => 'A tag selecionada é inválida.',
        ];
    }
}
