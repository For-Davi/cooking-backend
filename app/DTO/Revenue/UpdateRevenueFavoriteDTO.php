<?php

namespace App\DTO\Revenue;

class UpdateRevenueFavoriteDTO
{
    public function __construct(
        public readonly int $is_favorite,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            is_favorite: $data['favorite'],
        );
    }

    public function toArray(): array
    {
        return [
            'is_favorite' => $this->is_favorite,
        ];
    }
}
