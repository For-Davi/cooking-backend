<?php

namespace App\Http\Requests\Revenue;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRevenueFavoriteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'revenueID' => 'required|exists:revenues,id',
        ];
    }

    public function messages(): array
    {
        return [
            'revenueID.required' => 'O ID da receita é obrigatória.',
            'revenueID.exists' => 'A receita informada não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
