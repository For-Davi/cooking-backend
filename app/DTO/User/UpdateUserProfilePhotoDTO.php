<?php

namespace App\DTO\User;

class UpdateUserProfilePhotoDTO
{
    public function __construct(
        public ?int $photo_add_id,
        public ?int $photo_delete_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            photo_add_id: $data['photoAdd'],
            photo_delete_id: $data['photoDelete'],
        );
    }

    public function toArray(): array
    {
        return [
            'photo_add_id' => $this->photo_add_id,
            'photo_delete_id' => $this->photo_delete_id,
        ];
    }
}
