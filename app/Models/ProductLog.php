<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductLog extends Model
{
    use Notifiable;

    protected $table = 'product_log';

    protected $fillable = [
        'product_id',
        'execution',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
