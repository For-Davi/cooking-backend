<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SupplierCatalogHelper
{
    public static function existsBond($variantID, $supplierID)
    {
        $existing = DB::table('supplier_catalog')
            ->where('product_variant_id', $variantID)
            ->where('supplier_id', $supplierID)
            ->first();

        if ($existing) {
            throw ValidationException::withMessages([
                'bond' => ['O fornecedor já está vinculado a essa variante'],
            ]);
        }
    }
}
