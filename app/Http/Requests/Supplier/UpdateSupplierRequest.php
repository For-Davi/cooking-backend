<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'cpf' => 'nullable|string|size:11',
            'cnpj' => 'nullable|string|size:14',
            'state_registration' => 'nullable|string|max:20',
            'municipal_registration' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'site' => 'nullable|url|max:100',
            'country' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:2',
            'city' => 'nullable|string|max:50',
            'cep' => 'nullable|string|size:8',
            'neighborhood' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'number' => 'nullable|string|max:10',
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
            'cpf.size' => 'O CPF deve ter exatamente 11 dígitos',
            'cnpj.size' => 'O CNPJ deve ter exatamente 14 dígitos',

            // Registrations
            'state_registration.max' => 'A inscrição estadual não pode exceder 20 caracteres',
            'municipal_registration.max' => 'A inscrição municipal não pode exceder 20 caracteres',

            // Contact
            'phone.max' => 'O telefone não pode exceder 20 caracteres',
            'site.url' => 'O site deve ser uma URL válida',
            'site.max' => 'O site não pode exceder 100 caracteres',

            // Address
            'country.max' => 'O país não pode exceder 50 caracteres',
            'state.max' => 'O estado deve ter 2 caracteres',
            'city.max' => 'A cidade não pode exceder 50 caracteres',
            'cep.size' => 'O CEP deve ter exatamente 8 dígitos',
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
        ];
    }
}
