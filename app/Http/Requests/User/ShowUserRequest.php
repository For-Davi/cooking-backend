<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ShowUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userID' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'userID.required' => 'O ID do usuário é obrigatório',
            'userID.exists' => 'O ID do usuário informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
