<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PasswordResetToken extends Model
{
    use Notifiable;

    protected $table = 'password_reset_tokens';

    protected $fillable = [
        'email',
        'code',
    ];
}
