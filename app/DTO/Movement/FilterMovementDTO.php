<?php

namespace App\DTO\Movement;

class FilterMovementDTO
{
    public function __construct(
        public readonly ?string $period,
        public readonly string $type,
        public readonly ?int $category,
        public readonly int $enterprise_id,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            period: $data['period'],
            type: $data['type'],
            category: $data['category'],
            enterprise_id: $data['enterpriseID'],
        );
    }

    public function toArray(): array
    {
        return [
            'period' => $this->period,
            'type' => $this->type,
            'category' => $this->category,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
