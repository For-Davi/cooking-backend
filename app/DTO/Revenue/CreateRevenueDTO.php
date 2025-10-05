<?php

namespace App\DTO\Revenue;

use Illuminate\Support\Facades\Auth;

class CreateRevenueDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $preparation_method,
        public readonly int $time,
        public readonly int $portions,
        public readonly ?int $category_id,
        public readonly ?int $image_id,
        public readonly int $user_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            time: $data['time'],
            portions: $data['portions'],
            preparation_method: $data['preparationMethod'],
            category_id: $data['categoryID'],
            image_id: $data['imageID'],
            user_id: Auth::id(),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'time' => $this->time,
            'portions' => $this->portions,
            'preparation_method' => $this->preparation_method,
            'category_id' => $this->category_id,
            'image_id' => $this->image_id,
            'user_id' => $this->user_id,
        ];
    }
}
