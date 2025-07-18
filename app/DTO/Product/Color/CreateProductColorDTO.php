<?php

namespace App\DTO\Product\Color;

class CreateProductColorDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $hex_color_code,
        public readonly string $enterprise_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            hex_color_code: $data['hexColorCode'],
            enterprise_id: $data['enterpriseID'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'hex_color_code' => $this->hex_color_code,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
