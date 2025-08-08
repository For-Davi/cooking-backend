<?php

namespace App\DTO\Product;

class UpdateProductBasicDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly ?int $product_category_id,
        public readonly ?string $description,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            type: $data['type'],
            description: $data['description'],
            product_category_id: $data['category'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'product_category_id' => $this->product_category_id,
        ];
    }
}
