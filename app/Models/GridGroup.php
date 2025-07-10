<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GridGroup extends Model
{
    use Notifiable;

    protected $table = 'grid_groups';

    protected $fillable = [
        'name',
        'active',
        'enterprise_id',
    ];

    public function items()
    {
        return $this->hasMany(GridItem::class, 'grid_group_id', 'id')->orderBy('order');
    }
}
