<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductTag extends Model
{
    use Notifiable;

    protected $table = 'product_tag';

    protected $fillable = [
        'product_service_id',
        'tag_id',
        'enterprise_id',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductService::class);
    }
}
