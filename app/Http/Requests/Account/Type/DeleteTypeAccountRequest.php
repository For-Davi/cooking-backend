<?php

namespace App\Http\Requests\Account\Type;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTypeAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'typeID' => 'required|exists:transaction_categories,id',
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
