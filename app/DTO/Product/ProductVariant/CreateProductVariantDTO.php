<?php

namespace App\DTO\Product\ProductVariant;

class CreateProductVariantDTO
{
    public function __construct(
        public readonly int $active,
        public readonly ?string $sku,
        public readonly ?string $description,
        public readonly ?string $location,
        public readonly int $enterprise_id,
        public readonly int $product_id,
        public readonly ?int $grid_item_id,
        public readonly ?int $color_id,
        public readonly float $price,
        public readonly float $cost,
        public readonly float $stock_quantity,
        public readonly float $min_stock_quantity
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            active: $data['active'],
            sku: $data['sku'],
            description: $data['description'],
            location: $data['location'],
            product_id: $data['productID'],
            grid_item_id: $data['gridItemID'],
            color_id: $data['colorID'],
            price: $data['price'],
            cost: $data['cost'],
            stock_quantity: $data['stockQuantity'],
            min_stock_quantity: $data['minStockQuantity'],
            enterprise_id: $data['enterpriseID'],
        );
    }

    public function toArray(): array
    {
        return [
            'active' => $this->active,
            'sku' => $this->sku,
            'description' => $this->description,
            'location' => $this->location,
            'product_id' => $this->product_id,
            'grid_item_id' => $this->grid_item_id,
            'color_id' => $this->color_id,
            'price' => $this->price,
            'cost' => $this->cost,
            'stock_quantity' => $this->stock_quantity,
            'min_stock_quantity' => $this->min_stock_quantity,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
