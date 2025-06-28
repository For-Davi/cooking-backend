<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'id' => 'required|exists:employees,id',
            'name' => 'required|string|min:1|max:100',
            'email' => 'nullable|email|max:100',
            'sex' => 'nullable|in:M,F',
            'phone' => 'nullable|string|max:20',
            'cpf' => 'nullable|numeric',
            'cnpj' => 'nullable|numeric',
            'stateRegistration' => 'nullable|string|max:20',
            'municipalRegistration' => 'nullable|string|max:20',
            'dateBirthday' => 'nullable|string',
            'cep' => 'nullable|numeric',
            'country' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:50',
            'neighborhood' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'number' => 'nullable|numeric',
            'complement' => 'nullable|string|max:100',
            'departmentId' => 'nullable|exists:departments,id',
            'description' => 'nullable|string|max:500',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do funcionário é obrigatório',
            'id.exists' => 'O ID do funcionário informado não existe.',
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',
            'name.min' => 'O nome deve ter pelo menos 1 caractere.',
            'name.max' => 'O nome não pode ter mais de 100 caracteres.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.max' => 'O e-mail não pode ter mais de 100 caracteres.',
            'sex.in' => 'O sexo deve ser M (masculino) ou F (feminino).',
            'phone.string' => 'O telefone deve ser um texto.',
            'phone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'cpf.numeric' => 'O CPF deve conter apenas números.',
            'cnpj.numeric' => 'O CNPJ deve conter apenas números.',
            'stateRegistration.string' => 'A inscrição estadual deve ser um texto.',
            'stateRegistration.max' => 'A inscrição estadual não pode ter mais de 20 caracteres.',
            'municipalRegistration.string' => 'A inscrição municipal deve ser um texto.',
            'municipalRegistration.max' => 'A inscrição municipal não pode ter mais de 20 caracteres.',
            'dateBirthday.string' => 'A data de nascimento deve ser um texto.',
            'cep.numeric' => 'O CEP deve conter apenas números.',
            'country.string' => 'O país deve ser um texto.',
            'country.max' => 'O país não pode ter mais de 50 caracteres.',
            'state.string' => 'O estado deve ser um texto.',
            'state.max' => 'O estado não pode ter mais de 20 caracteres.',
            'city.string' => 'A cidade deve ser um texto.',
            'city.max' => 'A cidade não pode ter mais de 50 caracteres.',
            'neighborhood.string' => 'O bairro deve ser um texto.',
            'neighborhood.max' => 'O bairro não pode ter mais de 50 caracteres.',
            'address.string' => 'O endereço deve ser um texto.',
            'address.max' => 'O endereço não pode ter mais de 100 caracteres.',
            'number.numeric' => 'O número deve conter apenas números.',
            'complement.string' => 'O complemento deve ser um texto.',
            'complement.max' => 'O complemento não pode ter mais de 100 caracteres.',
            'departmentId.exists' => 'O departamento selecionado é inválido.',
            'description.string' => 'A descrição deve ser um texto.',
            'description.max' => 'A descrição não pode ter mais de 500 caracteres.',
        ];
    }
}
