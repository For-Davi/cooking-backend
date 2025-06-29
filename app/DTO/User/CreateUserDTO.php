<?php

namespace App\DTO\User;

use Illuminate\Support\Facades\Hash;

class CreateUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public int $enterprise_id,
        public ?int $department_id,
        public int $role_id
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            password: Hash::make($data['password']),
            email: $data['email'],
            enterprise_id: $data['enterprise_id'],
            department_id: $data['departmentId'],
            role_id: $data['roleId']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role_id,
            'enterprise_id' => $this->enterprise_id,
            'department_id' => $this->department_id,
        ];
    }
}
