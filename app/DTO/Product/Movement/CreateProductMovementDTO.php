<?php

namespace App\DTO\Product\Movement;

use Illuminate\Support\Facades\DB;

class CreateProductMovementDTO
{
    public function __construct(
        public readonly string $reason,
        public readonly string $type,
        public readonly ?string $document_number,
        public readonly ?string $lot_number,
        public readonly float $quantity,
        public readonly float $previous_stock,
        public readonly float $new_stock,
        public readonly float $unit_cost,
        public readonly float $total_cost,
        public readonly int $product_variant_id,
        public readonly ?int $supplier_id,
        public readonly int $created_by,
        public readonly int $enterprise_id,
        public readonly ?string $description,
    ) {}

    public static function fromRequest($data): self
    {

        $variant = DB::table('product_variants')->where('id', $data['variantID'])->first();

        $previousStock = (float) $variant->stock_quantity;
        $quantity = (float) $data['quantity'];

        $newStock = $data['type'] === 'in'
            ? $previousStock + $quantity
            : $previousStock - $quantity;

        return new self(
            reason: $data['reason'],
            type: $data['type'],
            document_number: $data['documentNumber'],
            lot_number: $data['lotNumber'],
            quantity: $quantity,
            previous_stock: $previousStock,
            new_stock: $newStock,
            unit_cost: (float) ($data['unitCost'] ?? 0),
            total_cost: (float) ($data['totalCost'] ?? 0),
            product_variant_id: $data['variantID'],
            supplier_id: $data['supplierID'],
            created_by: $data['createdBY'],
            enterprise_id: $data['enterpriseID'],
            description: $data['description'],
        );
    }

    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'reason' => $this->reason,
            'type' => $this->type,
            'document_number' => $this->document_number,
            'lot_number' => $this->lot_number,
            'quantity' => $this->quantity,
            'previous_stock' => $this->previous_stock,
            'new_stock' => $this->new_stock,
            'unit_cost' => $this->unit_cost,
            'total_cost' => $this->total_cost,
            'product_variant_id' => $this->product_variant_id,
            'supplier_id' => $this->supplier_id,
            'created_by' => $this->created_by,
            'enterprise_id' => $this->enterprise_id,
        ];
    }
}
