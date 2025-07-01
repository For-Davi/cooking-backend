<?php

namespace App\DTO\Grid\Group;

class CreateGridGroupDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $enterprise_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            enterprise_id: $data['enterprise_id']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
