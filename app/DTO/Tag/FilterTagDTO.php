<?php

namespace App\DTO\Tag;

class FilterTagDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?int $active,
        public readonly ?int $enterprise_id,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'] !== '' ? $data['name'] : null,
            active: $data['active'],
            enterprise_id: $data['enterpriseID'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'active' => $this->active,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
