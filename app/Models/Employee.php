<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use Notifiable;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'cnpj',
        'state_registration',
        'municipal_registration',
        'phone',
        'country',
        'state',
        'city',
        'cep',
        'neighborhood',
        'address',
        'number',
        'active',
        'complement',
        'has_login_access',
        'active',
        'enterprise_id',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }
}
