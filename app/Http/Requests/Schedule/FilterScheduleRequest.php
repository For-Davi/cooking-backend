<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class FilterScheduleRequest extends FormRequest
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
            'type.required' => 'O tipo de agendamento é obrigatório',
            'type.in' => 'O tipo de agendamento deve ser "all", "entry" ou "out"',
            'category.exists' => 'A categoria selecionada não existe',
        ];
    }
}
