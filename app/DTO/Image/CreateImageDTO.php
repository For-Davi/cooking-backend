<?php

namespace App\DTO\Image;

class CreateImageDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
        public readonly string $enterprise_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            url: $data['url'],
            enterprise_id: $data['enterpriseID'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
