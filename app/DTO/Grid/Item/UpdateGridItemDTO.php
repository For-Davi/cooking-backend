<?php

namespace App\DTO\Grid\Item;

class UpdateGridItemDTO
{
    public function __construct(
        public string $size,
        public int $active,
        public int $order,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            size: $data['size'],
            active: $data['active'],
            order: $data['order'],
        );
    }

    public function toArray(): array
    {
        return [
            'size' => $this->size,
            'active' => $this->active,
            'order' => $this->order,
        ];
    }
}
