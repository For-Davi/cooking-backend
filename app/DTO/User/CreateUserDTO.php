<?php

namespace App\DTO\User;

use Illuminate\Support\Facades\Hash;

class CreateUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            password: Hash::make($data['password']),
            email: $data['email'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
