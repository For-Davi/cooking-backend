<?php

namespace App\DTO\User;

class UpdateUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $department_id,
        public string $role_id,
        public int $active
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            department_id: $data['departmentId'],
            role_id: $data['roleId'],
            active: $data['active'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'department_id' => $this->department_id,
            'active' => $this->active,
        ];
    }
}
