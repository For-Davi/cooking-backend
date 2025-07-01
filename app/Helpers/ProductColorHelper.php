<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class ProductColorHelper
{
    public static function existsColor($entepriseId, $name, $mode, $colorId = null)
    {
        $existingColor = DB::table('product_colors')
            ->where('enterprise_id', $entepriseId)
            ->where('name', $name)
            ->first();

        if ($mode === 'create') {
            if ($existingColor) {
                throw new \Exception('Já existe uma cor com esse nome.');
            }
        } else {
            if ($existingColor && $existingColor->id !== $colorId) {
                throw new \Exception('Já existe outra cor com esse nome.');
            }
        }
    }
}
