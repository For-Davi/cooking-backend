<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GridItem extends Model
{
    use Notifiable;

    protected $table = 'grid_items';

    protected $fillable = [
        'size',
        'active',
        'order',
        'grid_group_id',
        'enterprise_id',
    ];
}
