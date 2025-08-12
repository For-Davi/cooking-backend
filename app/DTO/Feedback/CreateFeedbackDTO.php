<?php

namespace App\DTO\Feedback;

class CreateFeedbackDTO
{
    public function __construct(
        public readonly string $text,
        public readonly string $enterprise_name,
        public readonly string $user_name,
        public readonly string $user_email,
        public readonly ?int $image_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            text: $data['text'],
            enterprise_name: $data['enterprise_name'],
            user_name: $data['user_name'],
            user_email: $data['user_email'],
            image_id: $data['image_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'enterprise_name' => $this->enterprise_name,
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'image_id' => $this->image_id,
        ];
    }
}
