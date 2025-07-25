<?php

namespace App\DTO\Product\ProductImage;

class CreateProductImageDTO
{
    public function __construct(
        public readonly int $image_id,
        public readonly int $product_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            image_id: $data['imageID'],
            product_id: $data['productID'],
        );
    }

    public function toArray(): array
    {
        return [
            'image_id' => $this->image_id,
            'product_id' => $this->product_id,
        ];
    }
}
