<?php

namespace App\Http\Requests\Movement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:movements,id',
            'value' => 'required|numeric|min:0',
            'transactionCategoryID' => 'nullable|exists:transaction_categories,id',
            'description' => 'nullable|string|max:500',
            'date' => 'required|date_format:m/d/Y',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID da movimentação é obrigatória',
            'id.exists' => 'O ID da movimentação informada não existe',
            'value.required' => 'O valor da movimentação é obrigatório',
            'value.numeric' => 'O valor deve ser numérico',
            'value.min' => 'O valor mínimo permitido é 0',
            'transactionCategoryID.exists' => 'A categoria de transação informada não existe',
            'description.string' => 'A descrição deve ser um texto',
            'description.max' => 'A descrição não pode ter mais que 500 caracteres',
            'date.required' => 'A data da movimentação é obrigatória.',
            'date.date_format' => 'A data deve estar no formato mm/dd/yyyy.',
        ];
    }
}
