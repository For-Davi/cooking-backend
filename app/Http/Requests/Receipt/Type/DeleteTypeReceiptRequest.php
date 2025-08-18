<?php

namespace App\Http\Requests\Receipt\Type;

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
            'typeID' => 'required|exists:types_receipt,id',
        ];
    }

    public function messages(): array
    {
        return [
            'typeID.required' => 'O ID do tipo é obrigatório.',
            'typeID.exists' => 'O ID do tipo informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
