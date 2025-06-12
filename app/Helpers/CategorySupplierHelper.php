<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class CategorySupplierHelper
{
    public static function existsCategory($entepriseId, $name, $mode, $categoryId = null)
    {
        $existingCategory = DB::table('categories_supplier')
            ->where('enterprise_id', $entepriseId)
            ->where('name', $name)
            ->first();

        if ($mode === 'create') {
            if ($existingCategory) {
                throw new \Exception('Já existe uma categoria com esse nome.');
            }
        } else {
            if ($existingCategory && $existingCategory->id !== $categoryId) {
                throw new \Exception('Já existe outra categoria com esse nome.');
            }
        }
    }
}
