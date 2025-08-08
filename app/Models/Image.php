<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use Notifiable;

    protected $table = 'images';

    protected $fillable = [
        'name',
        'url',
        'enterprise_id',
        'size',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }
}
