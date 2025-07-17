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
            'clientID' => 'required|exists:clients,id',
        ];
    }

    public function messages(): array
    {
        return [
            'clientID.required' => 'O ID do cliente é obrigatório',
            'clientID.exists' => 'O ID do cliente informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
