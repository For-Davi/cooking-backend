<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends FormRequest
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
            'userID.required' => 'O ID do usuário é obrigatório.',
            'userID.exists' => 'O usuário informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
