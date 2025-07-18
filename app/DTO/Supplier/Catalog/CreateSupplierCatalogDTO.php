<?php

namespace App\DTO\Supplier\Catalog;

use App\Enums\SupplierType;

class CreateSupplierCatalogDTO
{
    public function __construct(
        public string $name,
        public string $type,
        public int $supplier_id,
        public int $enterprise_id,
        public ?string $description,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            type: $data['type'] ?? SupplierType::PRODUCT->value,
            supplier_id: $data['supplierID'],
            enterprise_id: $data['enterpriseID'],
            description: $data['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'supplier_id' => $this->supplier_id,
            'enterprise_id' => $this->enterprise_id,
            'description' => $this->description,
        ];
    }
}
