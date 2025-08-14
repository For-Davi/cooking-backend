<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Receipts extends Model
{
    use Notifiable;

    protected $table = 'receipts';

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

    public function type()
    {
        return $this->belongsTo(TypeReceipt::class, 'type_receipt_id');
    }
}
