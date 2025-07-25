<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductAdvanced extends Model
{
    use Notifiable;

    protected $table = 'product_advanced';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'active',
        'allow_coupon',
        'allow_discount',
        'discount_max_percentage',
        'has_commission',
        'commission_percentage',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
