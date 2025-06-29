<?php

namespace App\DTO\Employee;

class StartEmployeeDTO
{
    public function __construct(
        public string $name,
        public readonly ?string $email,
        public readonly int $has_login_access,
        public readonly int $enterprise_id,
        public readonly ?int $department_id,
        public readonly ?int $user_id,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            department_id: $data['departmentId'],
            enterprise_id: $data['enterpriseId'],
            has_login_access: $data['hasLoginAccess'],
            user_id: $data['userId'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'department_id' => $this->department_id,
            'user_id' => $this->user_id,
            'enterprise_id' => $this->enterprise_id,
            'has_login_access' => $this->has_login_access,
        ];
    }
}
