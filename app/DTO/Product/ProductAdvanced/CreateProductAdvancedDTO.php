<?php

namespace App\DTO\Product\ProductAdvanced;

class CreateProductAdvancedDTO
{
    public function __construct(
        public readonly int $product_id,
        public readonly int $active,
        public readonly int $allow_coupon,
        public readonly int $allow_discount,
        public readonly int $discount_max_percentage,
        public readonly int $has_commission,
        public readonly int $commission_percentage,
    ) {}

    public static function fromRequest($data): self
    {
        return new self(
            product_id: $data['productID'],
            active: $data['active'],
            allow_coupon: $data['allowCoupon'],
            allow_discount: $data['allowDiscount'],
            discount_max_percentage: $data['discountMaxPercentage'],
            has_commission: $data['hasCommission'],
            commission_percentage: $data['commissionPercentage'],
        );
    }

    public function toArray(): array
    {
        return [
            'product_id' => $this->product_id,
            'active' => $this->product_id,
            'allow_coupon' => $this->product_id,
            'allow_discount' => $this->product_id,
            'discount_max_percentage' => $this->product_id,
            'has_commission' => $this->product_id,
            'commission_percentage' => $this->product_id,
        ];
    }
}
