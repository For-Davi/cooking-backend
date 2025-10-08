<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use Notifiable;

    protected $table = 'images';

    protected $fillable = [
        'name',
        'url',
        'user_id',
        'size',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
