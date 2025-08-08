<?php

namespace App\DTO\User;

class UpdateUserPasswordDTO
{
    public function __construct(
        public string $password,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            password: $data['newPassword'],
        );
    }

    public function toArray(): array
    {
        return [
            'password' => $this->password,
        ];
    }
}
