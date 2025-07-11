<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Measure extends Model
{
    use Notifiable;

    protected $table = 'measures';

    protected $fillable = [
        'name',
        'active',
        'enterprise_id',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }
}
