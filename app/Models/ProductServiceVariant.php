<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductServiceVariant extends Model
{
    use Notifiable;

    protected $table = 'products_services_variants';

    protected $fillable = [
        'product_service_id',
        'price',
        'cost',
        'stock_quantity',
        'min_stock_alert',
        'sku',
        'active',
        'grid_item_id',
        'enterprise_id',
        'color_id',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function measure()
    {
        return $this->belongsTo(Measure::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function size()
    {
        return $this->belongsTo(GridItem::class, 'grid_item_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductService::class, 'product_service_id');
    }
}
