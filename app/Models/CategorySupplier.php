<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategorySupplier extends Model
{
    use Notifiable;

    protected $table = 'categories_supplier';

    protected $fillable = [
        'name',
        'enterprise_id',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class, 'enterprise_id');
    }
}
