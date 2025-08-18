<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class ShowScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'scheduleID' => 'required|exists:schedules,id',
        ];
    }

    public function messages(): array
    {
        return [
            'scheduleID.required' => 'O ID do agendamento é obrigatório',
            'scheduleID.exists' => 'O ID do agendamento informado não existe',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
