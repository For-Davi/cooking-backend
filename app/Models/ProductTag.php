<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductTag extends Model
{
    use Notifiable;

    protected $table = 'product_tag';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'tag_id',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
