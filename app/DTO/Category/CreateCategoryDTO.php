<?php

namespace App\DTO\Category;

use Illuminate\Support\Facades\Auth;

class CreateCategoryDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $user_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            user_id: Auth::id()
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'user_id' => $this->user_id,
        ];
    }
}
