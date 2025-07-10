<?php

namespace App\DTO\Grid\Item;

class UpdateGridItemDTO
{
    public function __construct(
        public string $size,
        public int $active,
        public int $order,
        public readonly int $enterprise_id,
        public readonly int $grid_group_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            size: $data['size'],
            active: $data['active'],
            order: $data['order'],
            grid_group_id: $data['gridGroupID'],
            enterprise_id: $data['enterpriseID']
        );
    }

    public function toArray(): array
    {
        return [
            'size' => $this->size,
            'active' => $this->active,
            'order' => $this->order,
            'grid_group_id' => $this->grid_group_id,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
