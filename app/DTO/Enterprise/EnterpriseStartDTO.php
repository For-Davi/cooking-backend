<?php

namespace App\DTO\Enterprise;

use Illuminate\Support\Facades\DB;

class EnterpriseStartDTO
{
    public function __construct(
        public string $name,
        public int $subscription_id
    ) {}

    public static function fromRequest($data): self
    {
        $subscription = DB::table('subscriptions')
            ->where('name', 'free')
            ->first();

        return new self(
            name: $data['nameEnterprise'],
            subscription_id: $subscription->id
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'subscription_id' => $this->subscription_id,
        ];
    }
}
