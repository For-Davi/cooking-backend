<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Revenue extends Model
{
    use Notifiable;

    protected $table = 'revenues';

    protected $fillable = [
        'name',
        'time',
        'portions',
        'preparation_method',
        'is_favorite',
        'category_id',
        'difficulty',
        'image_id',
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

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function ingredients()
    {
        return $this->belongsTo(RevenueIngredient::class, 'revenue_id');
    }
}
