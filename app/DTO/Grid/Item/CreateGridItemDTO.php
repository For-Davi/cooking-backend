<?php

namespace App\DTO\Grid\Item;

class CreateGridItemDTO
{
    public function __construct(
        public readonly string $size,
        public readonly int $order,
        public readonly string $enterprise_id,
        public readonly string $grid_group_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            size: $data['size'],
            order: $data['order'],
            grid_group_id: $data['gridGroupID'],
            enterprise_id: $data['enterpriseID']
        );
    }

    public function toArray(): array
    {
        return [
            'size' => $this->size,
            'order' => $this->order,
            'grid_group_id' => $this->grid_group_id,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
