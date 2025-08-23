<?php

namespace App\Http\Requests\Export;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|string|date_format:m/Y',
            'out' => 'required|boolean',
            'entry' => 'required|boolean',
            'categoryId' => 'nullable|exists:categories,id'
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'A data é obrigatória',
            'date.date_format' => 'O formato da data deve ser MM/YYYY',
            'out.required' => 'O campo out deve ser obrigatório',
            'out.boolean' => 'O campo out deve ser um boolean',
            'entry.required' => 'O campo entry deve ser obrigatório',
            'entry.boolean' => 'O campo entry deve ser um boolean',
            'categoryId.exists' => 'A categoria informada não existe'
        ];
    }
}
