<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class CategoryHelper
{
    public static function existsCategory($name, $mode, $categoryID = null)
    {
        $existingCategory = DB::table('categories')
            ->where('user_id', Auth::id())
            ->where('name', $name)
            ->first();

        if ($mode === 'create') {
            if ($existingCategory) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe uma categoria com esse nome'],
                ]);
            }
        } else {
            if ($existingCategory && $existingCategory->id !== $categoryID) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe uma categoria com esse nome'],
                ]);
            }
        }
    }
}
