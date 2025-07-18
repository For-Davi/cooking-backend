<?php

namespace App\Http\Requests\ProductService;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:suppliers,id',
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
            'complement' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:50',
            'cep' => 'nullable|numeric',
            'neighborhood' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'number' => 'nullable|numeric',
            'categorie_supplier_id' => 'nullable|exists:categories_supplier,id',
            'description' => 'nullable|string|max:500',
            'active' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID do fornecedor é obrigatório',
            'id.exists' => 'O ID do fornecedor informado não existe.',
            // Name
            'name.required' => 'O nome do fornecedor é obrigatório',
            'name.string' => 'O nome deve ser um texto',
            'name.min' => 'O nome do fornecedor deve ter pelo menos 1 caractere',
            'name.max' => 'O nome do fornecedor não pode exceder 100 caracteres',

            // Email
            'email.email' => 'O e-mail deve ser um endereço válido',
            'email.max' => 'O e-mail não pode exceder 100 caracteres',

            // CPF/CNPJ
            'cpf.numeric' => 'O CPF deve conter apenas números.',
            'cnpj.numeric' => 'O CNPJ deve conter apenas números.',

            // Registrations
            'state_registration.max' => 'A inscrição estadual não pode exceder 20 caracteres',
            'municipal_registration.max' => 'A inscrição municipal não pode exceder 20 caracteres',

            // Contact
            'phone.max' => 'O telefone não pode exceder 20 caracteres',
            'site.url' => 'O site deve ser uma URL válida',
            'site.max' => 'O site não pode exceder 100 caracteres',

            // Address
            'country.max' => 'O país não pode exceder 50 caracteres',
            'state.string' => 'O estado deve ser um texto.',
            'state.max' => 'O estado não pode exceder 20 caracteres.',
            'city.max' => 'A cidade não pode exceder 50 caracteres',
            'cep.numeric' => 'O CEP deve conter apenas números.',
            'neighborhood.max' => 'O bairro não pode exceder 50 caracteres',
            'address.max' => 'O endereço não pode exceder 100 caracteres',
            'number.max' => 'O número não pode exceder 10 caracteres',

            // Relations
            'categorie_supplier_id.exists' => 'A categoria selecionada é inválida',

            // Description
            'description.max' => 'A descrição não pode exceder 500 caracteres',

            // Status
            'active.required' => 'O status ativo/inativo é obrigatório',
            'active.in' => 'O status ativo deve ser 0 (inativo) ou 1 (ativo)',

            'complement.string' => 'O complemento do fornecedor deve ser um texto.',
            'complement.max' => 'O complement fornecedor não pode exceder 100 caracteres.',
        ];
    }
}
