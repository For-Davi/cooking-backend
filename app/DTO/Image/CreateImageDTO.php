<?php

namespace App\DTO\Image;

use Illuminate\Support\Facades\Auth;

class CreateImageDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
        public readonly int $size,
        public readonly string $user_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            size: $data['size'],
            url: $data['url'],
            user_id: Auth::id()
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'size' => $this->size,
            'url' => $this->url,
            'user_id' => $this->user_id,
        ];
    }
}
