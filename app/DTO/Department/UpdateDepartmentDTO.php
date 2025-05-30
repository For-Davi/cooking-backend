<?php

namespace App\DTO\Department;

class UpdateDepartmentDTO
{
    public function __construct(
        public string $name,
        public string $parent_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            parent_id: $data['parentId'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ];
    }
}
