<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Movement extends Model
{
    use Notifiable;

    protected $table = 'movements';

    protected $fillable = [
        'identifier',
        'type_receipt_id',
        'active',
        'enterprise_id',
        'description',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function category()
    {
        return $this->belongsTo(TransactionCategory::class, 'transaction_category_id');
    }
}
