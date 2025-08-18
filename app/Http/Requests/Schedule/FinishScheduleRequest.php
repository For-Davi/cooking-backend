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
            'close' => 'required|in:dateNow,dateSchedule',
            'scheduleID' => 'required|exists:schedules,id',
        ];
    }

    public function messages(): array
    {
        return [
            'close.required' => 'Deve ser informado o close',
            'close.in' => 'O close deve ser "dateNow" ou "dateSchedule"',
            'scheduleID.required' => 'O ID do agendamento é requirido',
            'scheduleID.exists' => 'O ID do agendamentto é inválido',
        ];
    }
}
