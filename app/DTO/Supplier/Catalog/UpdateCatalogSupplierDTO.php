<?php

namespace App\DTO\Supplier\Catalog;

use App\Enums\SupplierType;

class UpdateCatalogSupplierDTO
{
    public function __construct(
        public string $name,
        public string $type,
        public ?string $description,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            type: $data['type'] ?? SupplierType::PRODUCT->value,
            description: $data['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
        ];
    }
}
