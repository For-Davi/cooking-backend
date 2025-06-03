<?php

namespace App\DTO\Department;

class CreateDepartmentDTO
{
    public function __construct(
        public string $name,
        public ?string $parent_id,
        public string $enterprise_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            parent_id: $data['parentId'],
            enterprise_id: $data['enterprise_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'enterprise_id' => $this->enterprise_id,
            'parent_id' => $this->parent_id,
        ];
    }
}
