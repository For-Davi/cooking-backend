<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantTableResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product_variant_id' => $this->id,
            'name' => $this->product?->name,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'sku' => $this->sku,
            'variant_active' => $this->active,
            'color' => $this->color ? [
                'name' => $this->color->name,
                'hex_color_code' => $this->color->hex_color_code,
            ] : null,
        ];
    }
}
