<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ShowClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'clientId' => 'required|exists:clients,id',
        ];
    }

    public function messages(): array
    {
        return [
            'clientId.required' => 'O ID do cliente é obrigatório',
            'clientId.exists' => 'O ID do cliente informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
