<?php

namespace App\DTO\Tag;

class UpdateTagDTO
{
    public function __construct(
        public readonly string $name,
        public readonly int $active,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            active: $data['active'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'active' => $this->active,
        ];
    }
}
