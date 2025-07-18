<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SupplierCategoryHelper
{
    public static function existsCategory($enterpriseId, $name, $mode, $categoryId = null)
    {
        $existingCategory = DB::table('categories_supplier')
            ->where('enterprise_id', $enterpriseId)
            ->where('name', $name)
            ->first();

        if ($mode === 'create') {
            if ($existingCategory) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe uma categoria com esse nome.'],
                ]);
            }
        } else {
            if ($existingCategory && $existingCategory->id !== $categoryId) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe outra categoria com esse nome.'],
                ]);
            }
        }
    }
}
