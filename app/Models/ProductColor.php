<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductColor extends Model
{
    use Notifiable;

    protected $table = 'product_colors';

    protected $fillable = [
        'name',
        'active',
        'enterprise_id',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}
