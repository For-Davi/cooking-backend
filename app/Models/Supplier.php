<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Supplier extends Model
{
    use Notifiable;

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'state_registration',
        'municipal_registration',
        'phone',
        'site',
        'country',
        'state',
        'city',
        'cep',
        'neighborhood',
        'address',
        'number',
        'active',
        'categorie_supplier_id',
        'enterprise_id',
        'description',
    ];

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function category()
    {
        return $this->belongsTo(CategorySupplier::class, 'category_supplier_id');
    }
}
