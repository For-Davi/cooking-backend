<?php

namespace App\DTO\Employee;

class FilterEmployeeDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?int $cpf,
        public readonly ?int $cnpj,
        public readonly ?int $active,
        public readonly ?int $has_access_login,
        public readonly ?int $enterprise_id,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'] !== '' ? $data['name'] : null,
            email: $data['email'] !== '' ? $data['email'] : null,
            cpf: $data['cpf'] !== '' ? $data['cpf'] : null,
            cnpj: $data['cnpj'] !== '' ? $data['cnpj'] : null,
            active: $data['active'],
            has_access_login: $data['hasAccessLogin'],
            enterprise_id: $data['enterprise_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'active' => $this->active,
            'has_access_login' => $this->has_access_login,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
