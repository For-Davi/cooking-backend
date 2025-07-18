<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductCategoryHelper
{
    public static function existsCategory($enterpriseId, $name, $mode, $categoryID = null)
    {
        $existingCategory = DB::table('product_categories')
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
            if ($existingCategory && $existingCategory->id !== $categoryID) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe outra categoria com esse nome.'],
                ]);
            }
        }
    }
}
