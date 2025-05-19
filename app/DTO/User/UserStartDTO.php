<?php

namespace App\DTO\User;

use App\Enums\RoleUser;
use Illuminate\Support\Facades\Hash;

class UserStartDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $enterprise_id,
        public string $role
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            enterprise_id: $data['enterprise_id'],
            password: Hash::make($data['password']),
            role: 'master'
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
