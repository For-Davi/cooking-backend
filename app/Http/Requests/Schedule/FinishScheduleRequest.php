<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class FinishScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'close' => 'required|in:date_now,date_schedule',
            'value' => 'required|numeric|min:0',
            'transactionCategoryID' => 'nullable|exists:transaction_categories,id',
            'description' => 'nullable|string|max:500',
            'date' => 'required|date_format:d/m/Y',
            'type' => 'required|in:entry,out',
        ];
    }

    public function messages(): array
    {
        return [
            'close.required' => 'Deve ser informado o close',
            'close.in' => 'O close deve ser "date_now" ou "date_schedule"',
            'value.required' => 'O valor do agendamento é obrigatório.',
            'value.numeric' => 'O valor deve ser numérico.',
            'value.min' => 'O valor mínimo permitido é 0.',
            'transactionCategoryID.exists' => 'A categoria de transação informada não existe.',
            'description.string' => 'A descrição deve ser um texto.',
            'description.max' => 'A descrição não pode ter mais que 500 caracteres.',
            'date.required' => 'A data do agendamento é obrigatória.',
            'date.date_format' => 'A data deve estar no formato dd/mm/yyyy.',
            'type.required' => 'O tipo de agendamento é obrigatório.',
            'type.in' => 'O tipo de agendamento deve ser "entry" (entrada) ou "out" (saída).',
        ];
    }
}
