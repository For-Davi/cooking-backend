<?php

namespace App\Http\Requests\Revenue;

use Illuminate\Foundation\Http\FormRequest;

class CreateRevenueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:30',
            'time' => 'required|numeric',
            'portions' => 'required|numeric',
            'preparationMethod' => 'required|string',
            'ingredients' => 'required|array',
            'ingredients.*' => 'required|string',
            'categoryID' => 'nullable|exists:categories,id',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',
            'name.min' => 'O nome deve ter pelo menos 1 caractere.',
            'name.max' => 'O nome não pode ter mais de 30 caracteres.',
            'time.required' => 'O campo tempo é obrigatório.',
            'time.numeric' => 'O tempo deve ser um número.',
            'portions.required' => 'O campo porções é obrigatório.',
            'portions.numeric' => 'As porções devem ser um número.',
            'preparationMethod.required' => 'O campo método de preparo é obrigatório.',
            'preparationMethod.string' => 'O método de preparo deve ser um texto.',
            'ingredients.required' => 'O campo ingredientes é obrigatório.',
            'ingredients.array' => 'Os ingredientes devem ser uma lista.',
            'ingredients.*.required' => 'Cada ingrediente é obrigatório.',
            'ingredients.*.string' => 'Cada ingrediente deve ser um texto.',
            'categoryID.exists' => 'A categoria selecionada não existe.',
            'image.file' => 'A imagem deve ser um arquivo.',
            'image.mimes' => 'A imagem deve ser do tipo: jpg, jpeg ou png.',
            'image.max' => 'A imagem não pode ter mais de 3MB.',
        ];
    }
}
