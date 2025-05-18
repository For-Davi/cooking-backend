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
        public RoleUser $role
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: Hash::make($data['password']),
            role: RoleUser::ADMIN
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role->value,
        ];
    }
}
