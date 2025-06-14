<?php

namespace App\DTO\Supplier;

class UpdateSupplierDTO
{
    public function __construct(
        public string $name,
        public readonly ?string $email,
        public readonly ?int $cpf,
        public readonly ?int $cnpj,
        public readonly ?string $state_registration,
        public readonly ?string $municipal_registration,
        public readonly ?string $phone,
        public readonly ?string $site,
        public readonly ?string $country,
        public readonly ?string $state,
        public readonly ?string $city,
        public readonly ?int $cep,
        public readonly ?string $neighborhood,
        public readonly ?string $address,
        public readonly ?int $number,
        public readonly ?int $category_supplier_id,
        public readonly ?string $description,
        public readonly ?string $complement,
        public readonly string $enterprise_id,
        public readonly int $active,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            cpf: $data['cpf'],
            cnpj: $data['cnpj'],
            state_registration: $data['stateRegistration'],
            municipal_registration: $data['municipalRegistration'],
            phone: $data['phone'],
            site: $data['site'],
            country: $data['country'],
            state: $data['state'],
            city: $data['city'],
            cep: $data['cep'],
            neighborhood: $data['neighborhood'],
            address: $data['address'],
            number: $data['number'],
            category_supplier_id: $data['categorySupplierId'],
            description: $data['description'],
            complement: $data['complement'],
            enterprise_id: $data['enterpriseId'],
            active: $data['active'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'state_registration' => $this->state_registration,
            'municipal_registration' => $this->municipal_registration,
            'phone' => $this->phone,
            'site' => $this->site,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'cep' => $this->cep,
            'neighborhood' => $this->neighborhood,
            'address' => $this->address,
            'number' => $this->number,
            'category_supplier_id' => $this->category_supplier_id,
            'description' => $this->description,
            'complement' => $this->complement,
            'enterprise_id' => $this->enterprise_id,
            'active' => $this->active,
        ];
    }
}
