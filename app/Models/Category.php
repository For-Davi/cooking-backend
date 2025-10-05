<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
