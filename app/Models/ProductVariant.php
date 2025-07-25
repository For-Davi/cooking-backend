<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductVariant extends Model
{
    use Notifiable;

    protected $table = 'product_variants';

    protected $fillable = [
        'product_id',
        'price',
        'cost',
        'stock_quantity',
        'min_stock_alert',
        'sku',
        'active',
        'grid_item_id',
        'enterprise_id',
        'description',
        'location',
        'color_id',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
