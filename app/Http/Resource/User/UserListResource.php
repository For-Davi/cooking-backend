<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->account_number,
            'active' => $this->active,
            'department_name' => $this->department?->name,
            'role_name' => $this->role?->name,
        ];
    }
}
