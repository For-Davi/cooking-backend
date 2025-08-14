<?php

namespace App\Http\Requests\Movement;

use Illuminate\Foundation\Http\FormRequest;

class FilterMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'period' => 'nullable|date_format:m/Y',
            'type' => 'required|in:all,entry,out',
            'category' => 'nullable|exists:transaction_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'period.date_format' => 'O período deve estar no formato mm/yyyy',
            'type.required' => 'O tipo de movimentação é obrigatório',
            'type.in' => 'O tipo de movimentação deve ser "all", "entry" ou "out"',
            'category.exists' => 'A categoria selecionada não existe',
        ];
    }
}
