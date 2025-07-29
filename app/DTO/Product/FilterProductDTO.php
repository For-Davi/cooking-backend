<?php

namespace App\DTO\Product;

class FilterProductDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $sku,
        public readonly ?int $stockCritical,
        public readonly ?int $categoryID,
        public readonly ?int $active,
        public readonly ?int $enterpriseID,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            sku: $data['sku'],
            stockCritical: $data['stockCritical'],
            categoryID: $data['category'],
            enterpriseID: $data['enterpriseID'],
            active: $data['active']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'stockCritical' => $this->stockCritical,
            'categoryID' => $this->categoryID,
            'enterpriseID' => $this->enterpriseID,
            'active' => $this->active,
        ];
    }
}
