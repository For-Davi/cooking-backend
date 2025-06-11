<?php

use Illuminate\Support\Facades\DB;

class CategorySupplierHelper
{
    public static function existsCategory($id, $name, $mode)
    {
        $category = DB::table('categories_supplier')->where('id', $id)->first();

        if (! $category) {
            throw new \Exception('Categoria não encontrada.');
        }

        $existingCategory = DB::table('categories_supplier')
            ->where('enterprise_id', $category->enterprise_id)
            ->where('name', $name)
            ->first();

        if ($mode === 'create') {
            if ($existingCategory) {
                throw new \Exception('Já existe uma categoria com esse nome.');
            }
        } else {
            if ($existingCategory && $existingCategory->id !== $id) {
                throw new \Exception('Já existe outra categoria com esse nome.');
            }
        }
    }
}
