<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TypeAccountHelper
{
    public static function existsType($enterpriseId, $name, $mode, $typeID = null)
    {
        $existingType = DB::table('types_account')
            ->where('enterprise_id', $enterpriseId)
            ->where('name', $name)
            ->first();

        if ($mode === 'create') {
            if ($existingType) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe um tipo com esse nome.'],
                ]);
            }
        } else {
            if ($existingType && $existingType->id !== $typeID) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe outro tipo com esse nome.'],
                ]);
            }
        }
    }
}
