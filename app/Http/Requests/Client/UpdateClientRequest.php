<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:clients,id',
            'name' => 'required|string|min:1|max:100',
            'email' => 'nullable|email|max:100',
            'cpf' => 'nullable|numeric',
            'cnpj' => 'nullable|numeric',
            'stateRegistration' => 'nullable|string|max:20',
            'municipalRegistration' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'dateBirthday' => 'nullable|string',
            'country' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:50',
            'cep' => 'nullable|numeric',
            'neighborhood' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'number' => 'nullable|numeric',
            'complement' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',

        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do cliente é obrigatório',
            'id.exists' => 'O ID do cliente informado não existe.',
            'name.required' => 'O nome do fornecedor é obrigatório.',
            'name.string' => 'O nome do fornecedor deve ser um texto.',
            'name.min' => 'O nome do fornecedor deve ter pelo menos 1 caractere.',
            'name.max' => 'O nome do fornecedor não pode exceder 100 caracteres.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.max' => 'O e-mail não pode exceder 100 caracteres.',
            'cpf.numeric' => 'O CPF deve conter apenas números.',
            'cnpj.numeric' => 'O CNPJ deve conter apenas números.',
            'stateRegistration.string' => 'A inscrição estadual deve ser um texto.',
            'stateRegistration.max' => 'A inscrição estadual não pode exceder 20 caracteres.',
            'municipalRegistration.string' => 'A inscrição municipal deve ser um texto.',
            'municipalRegistration.max' => 'A inscrição municipal não pode exceder 20 caracteres.',
            'phone.string' => 'O telefone deve ser um texto.',
            'phone.max' => 'O telefone não pode exceder 20 caracteres.',
            'dateBirthday.string' => 'A data de aniversário deve ser um texto.',
            'country.string' => 'O país deve ser um texto.',
            'country.max' => 'O país não pode exceder 50 caracteres.',
            'state.string' => 'O estado deve ser um texto.',
            'state.max' => 'O estado não pode exceder 20 caracteres.',
            'city.string' => 'A cidade deve ser um texto.',
            'city.max' => 'A cidade não pode exceder 50 caracteres.',
            'cep.numeric' => 'O CEP deve conter apenas números.',
            'neighborhood.string' => 'O bairro deve ser um texto.',
            'neighborhood.max' => 'O bairro não pode exceder 50 caracteres.',
            'address.string' => 'O endereço deve ser um texto.',
            'address.max' => 'O endereço não pode exceder 100 caracteres.',
            'number.numeric' => 'O número deve conter apenas números.',
            'description.string' => 'A descrição deve ser um texto.',
            'description.max' => 'A descrição não pode exceder 500 caracteres.',
            'complement.string' => 'O complemento do fornecedor deve ser um texto.',
            'complement.max' => 'O complement fornecedor não pode exceder 100 caracteres.',
        ];
    }
}
