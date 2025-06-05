<?php

namespace App\DTO\User;

use Illuminate\Support\Facades\Hash;

class CreateUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $enterprise_id,
        public string $department_id,
        public string $role
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            password: Hash::make($data['password']),
            email: $data['email'],
            enterprise_id: $data['enterpriseId'],
            department_id: $data['departmentId'],
            role: $data['roleId']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role,
            'enterprise_id' => $this->enterprise_id,
            'department_id' => $this->department_id,
        ];
    }
}
