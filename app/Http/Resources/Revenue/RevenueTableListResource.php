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
            'is_favorite' => $this->is_favorite,
            'image' => $this->image,
            'category' => $this->category?->name
        ];
    }
}
