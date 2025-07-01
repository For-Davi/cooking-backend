<?php

namespace App\DTO\Grid\Group;

class UpdateGridGroupDTO
{
    public function __construct(
        public string $name,
        public int $active,
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
