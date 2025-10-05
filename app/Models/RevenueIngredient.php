<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RevenueIngredient extends Model
{
    use Notifiable;

    protected $table = 'revenue_ingredients';

    protected $fillable = [
        'name',
        'revenue_id',
    ];

    public function revenue()
    {
        return $this->belongsTo(Revenue::class, 'revenue_id');
    }
}
