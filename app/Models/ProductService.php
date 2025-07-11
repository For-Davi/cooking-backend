<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductService extends Model
{
    use Notifiable;

    protected $table = 'products_services';

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

    public function measure()
    {
        return $this->belongsTo(Measure::class);
    }
}
