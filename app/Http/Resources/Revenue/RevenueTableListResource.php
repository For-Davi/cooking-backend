<?php

namespace App\Http\Resources\Revenue;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RevenueTableListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'time' => $this->time,
            'portions' => $this->portions,
            'favorite' => $this->favorite,
            'category' => $this->category?->name
        ];
    }
}
