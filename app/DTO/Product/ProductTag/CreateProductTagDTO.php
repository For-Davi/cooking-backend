<?php

namespace App\DTO\Product\ProductTag;

class CreateProductTagDTO
{
    public function __construct(
        public readonly int $tag_id,
        public readonly int $product_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            tag_id: $data['tagID'],
            product_id: $data['productID'],
        );
    }

    public function toArray(): array
    {
        return [
            'tag_id' => $this->tag_id,
            'product_id' => $this->product_id,
        ];
    }
}
