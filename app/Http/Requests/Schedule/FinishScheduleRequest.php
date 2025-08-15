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
            'scheduleID' => 'required|exists:schedules,id'
        ];
    }

    public function messages(): array
    {
        return [
            'close.required' => 'Deve ser informado o close',
            'close.in' => 'O close deve ser "date_now" ou "date_schedule"',
            'scheduleID.required' => 'O ID do agendamento é requirido',
            'scheduleID.exists' => 'O ID do agendamentto é inválido'
        ];
    }
}
