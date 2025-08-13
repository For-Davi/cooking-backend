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
            'startDate' => 'nullable|date_format:m/Y',
            'endDate' => 'nullable|date_format:m/Y|after_or_equal:startDate',
            'type' => 'required|in:all,enter,out',
            'category' => 'nullable|exists:transaction_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'startDate.date_format' => 'A data inicial deve estar no formato mm/yyyy.',
            'endDate.date_format' => 'A data final deve estar no formato mm/yyyy.',
            'endDate.after_or_equal' => 'A data final deve ser igual ou posterior à data inicial.',
            'type.required' => 'O tipo de movimentação é obrigatório.',
            'type.in' => 'O tipo de movimentação deve ser "all", "enter" ou "out".',
            'category.exists' => 'A categoria selecionada não existe.',
        ];
    }
}
