<?php

namespace App\DTO\Category;

class UpdateCategoryDTO
{
    public function __construct(
        public string $name,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
