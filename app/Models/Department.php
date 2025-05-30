<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    use Notifiable;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'parent_id',
        'enterprise_id',
    ];
}
