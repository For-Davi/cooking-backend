<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feedback extends Model
{
    use Notifiable;

    protected $table = 'feedbacks';

    protected $fillable = [
        'text',
        'enterprise_name',
        'user_name',
        'user_email',
        'image_id',
    ];
}
