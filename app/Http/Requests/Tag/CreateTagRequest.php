<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class CreateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da cor é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome da cor não pode ter menos de 1 caracteres',
            'name.max' => 'O nome da cor não pode ter mais de 20 caracteres',
        ];
    }
}
