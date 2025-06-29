<?php

namespace App\DTO\Employee;

class FilterEmployeeDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $sex,
        public readonly ?int $cpf,
        public readonly ?int $cnpj,
        public readonly ?int $active,
        public readonly ?int $has_login_access,
        public readonly ?int $department_id,
        public readonly ?int $enterprise_id,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'] !== '' ? $data['name'] : null,
            email: $data['email'] !== '' ? $data['email'] : null,
            cpf: $data['cpf'] !== '' ? $data['cpf'] : null,
            cnpj: $data['cnpj'] !== '' ? $data['cnpj'] : null,
            sex: $data['sex'],
            active: $data['active'],
            has_login_access: $data['hasLoginAccess'],
            department_id: $data['department'],
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
            'sex' => $this->sex,
            'active' => $this->active,
            'has_access_login' => $this->has_login_access,
            'department_id' => $this->department_id,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
