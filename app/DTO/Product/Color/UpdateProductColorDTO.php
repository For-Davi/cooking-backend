<?php

namespace App\DTO\Product\Color;

class UpdateProductColorDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $hex_color_code,
        public readonly int $active,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            hex_color_code: $data['hexColorCode'],
            active: $data['active'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'hex_color_code' => $this->hex_color_code,
            'active' => $this->active,
        ];
    }
}
