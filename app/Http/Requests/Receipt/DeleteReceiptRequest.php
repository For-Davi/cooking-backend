<?php

namespace App\Http\Requests\Receipt;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTypeReceiptRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'receiptID' => 'required|exists:receipts',
        ];
    }

    public function messages(): array
    {
        return [
            'receiptID.required' => 'O ID do recebimento é obrigatório',
            'receiptID.exists' => 'O ID do recebimento informado não existe'
        ];
    }
}
