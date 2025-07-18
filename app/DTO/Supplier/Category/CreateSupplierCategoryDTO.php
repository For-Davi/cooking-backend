<?php

namespace App\DTO\Supplier\Category;

class CreateSupplierCategoryDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $enterprise_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            enterprise_id: $data['enterpriseID']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
