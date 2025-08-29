<?php

namespace App\DTO\Product\ProductVariant;

class UpdateProductVariantDTO
{
    public function __construct(
        public readonly int $active,
        public readonly ?string $sku,
        public readonly ?string $code,
        public readonly ?string $description,
        public readonly ?string $location,
        public readonly float $price,
        public readonly float $offer,
        public readonly float $cost,
        public readonly float $min_stock_alert
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            active: $data['active'],
            code: $data['code'],
            sku: $data['sku'],
            description: $data['description'],
            location: $data['location'],
            price: $data['price'],
            cost: $data['cost'],
            offer: $data['offer'],
            min_stock_alert: $data['minStockAlert'],
        );
    }

    public function toArray(): array
    {
        return [
            'active' => $this->active,
            'sku' => $this->sku,
            'code' => $this->code,
            'description' => $this->description,
            'location' => $this->location,
            'price' => $this->price,
            'cost' => $this->cost,
            'offer' => $this->offer,
            'min_stock_alert' => $this->min_stock_alert,
        ];
    }
}
