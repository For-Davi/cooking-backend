<?php

namespace App\Http\Requests\Movement;

use Illuminate\Foundation\Http\FormRequest;

class ExportMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'format' => 'required|in:excel,pdf',
            'period' => 'nullable|date_format:m/Y',
            'type' => 'required|in:all,entry,out',
            'category' => 'nullable|exists:transaction_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'format.required' => 'O formato do arquivo é obrigatório.',
            'format.in' => 'O formato deve ser "excel" ou "pdf".',
            'period.date_format' => 'O período deve estar no formato válido: mm/yyyy.',
            'type.required' => 'É necessário informar o tipo da movimentação.',
            'type.in' => 'O tipo de movimentação deve ser "all" (todas), "entry" (entradas) ou "out" (saídas).',
            'category.exists' => 'A categoria informada não foi encontrada.',
        ];
    }
}
