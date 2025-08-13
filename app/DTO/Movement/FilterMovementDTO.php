<?php

namespace App\DTO\Movement;

class FilterMovementDTO
{
    public function __construct(
        public readonly ?string $start_date,
        public readonly ?string $end_date,
        public readonly ?int $category,
        public readonly int $enterprise_id,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            start_date: $data['startDate'],
            end_date: $data['endDate'],
            category: $data['category'],
            enterprise_id: $data['enterpriseID'],
        );
    }

    public function toArray(): array
    {
        return [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'category' => $this->category,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
