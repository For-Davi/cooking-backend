<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tagID' => 'required|exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [
            'tagID.required' => 'O ID da tag é obrigatória.',
            'tagID.exists' => 'A tag informada não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
