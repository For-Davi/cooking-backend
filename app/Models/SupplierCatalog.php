<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SupplierCatalog extends Model
{
    use Notifiable;

    protected $table = 'supplier_catalog';

    protected $fillable = [
        'name',
        'type',
        'supplier_id',
        'enterprise_id',
        'description',
    ];

    protected $casts = [
        'type' => SupplierType::class,
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }
}
