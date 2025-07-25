<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductImage extends Model
{
    use Notifiable;

    protected $table = 'product_image';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'image_id',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
