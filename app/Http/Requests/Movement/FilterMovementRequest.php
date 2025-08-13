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
            'endDate' => 'nullable|date_format:m/Y',
            'category' => 'nullable|exists:transaction_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'startDate.date_format' => 'A data inicial deve estar no formato mm/yyyy.',
            'endDate.date_format' => 'A data final deve estar no formato mm/yyyy.',
            'category.exists' => 'A categoria selecionada não existe.',
        ];
    }
}
