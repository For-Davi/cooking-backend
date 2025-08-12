<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        if ($this->has('imagesToDelete')) {
            $this->merge([
                'imagesToDelete' => is_string($this->imagesToDelete)
                    ? json_decode($this->imagesToDelete, true)
                    : $this->imagesToDelete,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'productID' => 'required|exists:products,id',
            'newImages' => 'sometimes|array',
            'newImages.*' => 'file|mimes:jpg,jpeg,png,gif|max:3072', // 3MB
            'imagesToDelete' => 'sometimes|array',
            'imagesToDelete.*.id' => 'required|integer|exists:images,id',
        ];
    }

    public function messages(): array
    {
        return [
            'productID.required' => 'O ID do produto é obrigatório',
            'productID.exists' => 'O ID do produto informado não existe.',
            'newImages.*.file' => 'O arquivo de imagem é inválido.',
            'newImages.*.mimes' => 'Apenas imagens JPG, JPEG, PNG ou GIF são permitidas.',
            'newImages.*.max' => 'O tamanho máximo da imagem é 3MB.',
            'imagesToDelete.array' => 'O campo imagesToDelete deve ser um array.',
            'imagesToDelete.*.id.required' => 'O ID da imagem a ser deletada é obrigatório.',
            'imagesToDelete.*.id.integer' => 'O ID da imagem deve ser um número inteiro.',
            'imagesToDelete.*.id.exists' => 'Uma ou mais imagens selecionadas para exclusão não existem no banco de dados.',
        ];
    }
}
