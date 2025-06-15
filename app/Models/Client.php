<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use Notifiable;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'sex',
        'phone',
        'cpf',
        'cnpj',
        'state_registration',
        'municipal_registration',
        'date_birthday',
        'cep',
        'country',
        'state',
        'city',
        'neighborhood',
        'address',
        'complement',
        'number',
        'enterprise_id',
        'description',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }
}
