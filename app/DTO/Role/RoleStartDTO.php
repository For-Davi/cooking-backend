<?php

namespace App\DTO\Role;

class RoleStartDTO
{
    public function __construct(
        public string $name,
        public array $permissions,
        public string $enterprise_id
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: 'master',
            enterprise_id: $data['enterprise_id'],
            permissions: []
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'enterprise_id' => $this->enterprise_id,
            'permissions' => json_encode($this->permissions),
        ];
    }
}
