<?php

namespace App\DTO\Receipt\Type;

class CreateTypeReceiptDTO
{
    public function __construct(
        public readonly string $identifier,
        public readonly ?int $types_id,
        public readonly int $enterprise_id,
        public readonly ?string $description,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            identifier: $data['identifier'],
             types_id: $data['typesID'],
            enterprise_id: $data['enterpriseID'],
            description: $data['description']
        );
    }

    public function toArray(): array
    {
        return [
            'identifier' => $this->identifier,
            'types_id' => $this->types_id,
            'enterprise_id' => $this->enterprise_id,
            'description' => $this->description
        ];
    }
}
