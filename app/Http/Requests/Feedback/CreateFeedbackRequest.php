<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => 'required|string|max:5000',
            'images' => 'sometimes|array',
            'images.*' => 'file|mimes:jpg,jpeg,png,gif|max:3072'
        ];
    }

    public function messages(): array
    {
        return [
            'text.required' => 'O nome da categoria é obrigatório',
            'text.string' => 'O nome deve ser uma string',
            'text.max' => 'O nome da categoria não pode ter mais de 5000 caracteres',
            'images.*.file' => 'O arquivo de imagem é inválido.',
            'images.*.mimes' => 'Apenas imagens JPG, JPEG, PNG ou GIF são permitidas.',
            'images.*.max' => 'O tamanho máximo da imagem é 3MB.',
        ];
    }
}
