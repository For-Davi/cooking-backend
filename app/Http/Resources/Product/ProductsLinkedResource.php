<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsLinkedResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'variant_id' => $this->product_variant_id,
            'supplier_id' => $this->supplier_id,
            'name' => $this->variant->product->name,
            'price' => $this->price,
            'sku' => $this->variant->sku,
            'color_code' => $this->variant?->color?->hex_color_code,
            'color_name' => $this->variant?->color?->name
        ];
    }
}
