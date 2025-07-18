<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'type',
        'active',
        'measure_id',
        'enterprise_id',
        'description',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }
}
