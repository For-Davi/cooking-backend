<?php

namespace App\DTO\Revenue;

class UpdateRevenueDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $preparation_method,
        public readonly int $time,
        public readonly int $portions,
        public readonly ?int $category_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            time: $data['time'],
            portions: $data['portions'],
            preparation_method: $data['preparationMethod'],
            category_id: $data['categoryID'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'time' => $this->time,
            'portions' => $this->portions,
            'preparation_method' => $this->preparation_method,
            'category_id' => $this->category_id,
        ];
    }
}
