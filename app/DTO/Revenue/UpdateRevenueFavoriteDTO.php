<?php

namespace App\DTO\Revenue;

class UpdateRevenueFavoriteDTO
{
    public function __construct(
        public readonly int $favorite,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            favorite: $data['favorite'],
        );
    }

    public function toArray(): array
    {
        return [
            'favorite' => $this->favorite,
        ];
    }
}
