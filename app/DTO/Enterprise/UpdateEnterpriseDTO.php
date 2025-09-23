<?php

namespace App\DTO\Enterprise;

class UpdateEnterpriseDTO
{
    public function __construct(
        public string $name,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $cpf = null,
        public ?string $cnpj = null,
        public ?string $cep = null,
        public ?string $state = null,
        public ?string $city = null,
        public ?string $neighborhood = null,
        public ?string $address = null,
        public ?string $number_address = null,
        public ?string $complement = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            cpf: $data['cpf'] ?? null,
            cnpj: $data['cnpj'] ?? null,
            cep: $data['cep'] ?? null,
            state: $data['state'] ?? null,
            city: $data['city'] ?? null,
            neighborhood: $data['neighborhood'] ?? null,
            address: $data['address'] ?? null,
            number_address: $data['numberAddress'] ?? null,
            complement: $data['complement'] ?? null,
        );
    }

    public function toArray(): array
    {
        $data = array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cep' => $this->cep,
            'state' => $this->state,
            'city' => $this->city,
            'neighborhood' => $this->neighborhood,
            'address' => $this->address,
            'number_address' => $this->number_address,
            'complement' => $this->complement,
        ], fn ($value) => ! is_null($value) && $value !== '');

        $data['cpf'] = $this->cpf;
        $data['cnpj'] = $this->cnpj;

        return $data;
    }
}
