<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:100',
            'email' => 'nullable|email|max:100',
            'cpf' => 'nullable|numeric',
            'cnpj' => 'nullable|numeric',
            'state_registration' => 'nullable|string|max:20',
            'municipal_registration' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'site' => 'nullable|max:100',
            'country' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:50',
            'cep' => 'nullable|numeric',
            'neighborhood' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'number' => 'nullable|numeric',
            'category_supplier_id' => 'nullable|exists:categories_supplier,id',
            'description' => 'nullable|string|max:500',
            'complement' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            // Name
            'name.required' => 'O nome do fornecedor é obrigatório.',
            'name.string' => 'O nome do fornecedor deve ser um texto.',
            'name.min' => 'O nome do fornecedor deve ter pelo menos 1 caractere.',
            'name.max' => 'O nome do fornecedor não pode exceder 100 caracteres.',

            // Email
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.max' => 'O e-mail não pode exceder 100 caracteres.',

            // CPF
            'cpf.numeric' => 'O CPF deve conter apenas números.',

            // CNPJ
            'cnpj.numeric' => 'O CNPJ deve conter apenas números.',

            // State Registration
            'state_registration.string' => 'A inscrição estadual deve ser um texto.',
            'state_registration.max' => 'A inscrição estadual não pode exceder 20 caracteres.',

            // Municipal Registration
            'municipal_registration.string' => 'A inscrição municipal deve ser um texto.',
            'municipal_registration.max' => 'A inscrição municipal não pode exceder 20 caracteres.',

            // Phone
            'phone.string' => 'O telefone deve ser um texto.',
            'phone.max' => 'O telefone não pode exceder 20 caracteres.',

            // Site
            'site.max' => 'O site não pode exceder 100 caracteres.',

            // Country
            'country.string' => 'O país deve ser um texto.',
            'country.max' => 'O país não pode exceder 50 caracteres.',

            // State
            'state.string' => 'O estado deve ser um texto.',
            'state.max' => 'O estado não pode exceder 20 caracteres.',

            // City
            'city.string' => 'A cidade deve ser um texto.',
            'city.max' => 'A cidade não pode exceder 50 caracteres.',

            // CEP
            'cep.numeric' => 'O CEP deve conter apenas números.',

            // Neighborhood
            'neighborhood.string' => 'O bairro deve ser um texto.',
            'neighborhood.max' => 'O bairro não pode exceder 50 caracteres.',

            // Address
            'address.string' => 'O endereço deve ser um texto.',
            'address.max' => 'O endereço não pode exceder 100 caracteres.',

            // Number
            'number.numeric' => 'O número deve conter apenas números.',

            // Category Supplier ID
            'category_supplier_id.exists' => 'A categoria selecionada é inválida.',

            // Description
            'description.string' => 'A descrição deve ser um texto.',
            'description.max' => 'A descrição não pode exceder 500 caracteres.',

            'complement.string' => 'O complemento do fornecedor deve ser um texto.',
            'complement.max' => 'O complement fornecedor não pode exceder 100 caracteres.',
        ];
    }
}
