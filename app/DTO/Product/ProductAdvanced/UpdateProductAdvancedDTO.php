<?php

namespace App\DTO\Product\ProductAdvanced;

class UpdateProductAdvancedDTO
{
    public function __construct(
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
            'active' => $this->active,
            'allow_coupon' => $this->allow_coupon,
            'allow_discount' => $this->allow_discount,
            'discount_max_percentage' => $this->discount_max_percentage,
            'has_commission' => $this->has_commission,
            'commission_percentage' => $this->commission_percentage,
        ];
    }
}
