<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SupplierCatalog extends Model
{
    use Notifiable;

    protected $table = 'supplier_catalog';
    
    // Indica que não usa auto-increment
    public $incrementing = false;
    
    // Define a chave primária composta
    protected $primaryKey = ['supplier_id', 'product_variant_id'];
    
    protected $fillable = [
        'product_variant_id',
        'supplier_id',
        'price',
        'description',
        'enterprise_id',
    ];

    public $timestamps = true;

    /**
     * Set the keys for a save update query.
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getAttribute($keyName));
        }

        return $query;
    }

    /**
     * Get the value of the primary key.
     */
    public function getKey()
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::getKey();
        }

        $keyValues = [];
        foreach ($keys as $key) {
            $keyValues[$key] = $this->getAttribute($key);
        }

        return $keyValues;
    }

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}