<?php

namespace App\DTO\Revenue\Ingredient;

class CreateIngredientDTO
{
    public function __construct(
        public readonly string $name,
        public readonly int $revenue_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            revenue_id: $data['revenueID'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'revenue_id' => $this->revenue_id,
        ];
    }
}
