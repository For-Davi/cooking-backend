<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CodeHelper
{
    public static function existsCode($enterpriseId, $code, $mode, $variantID = null)
    {
        $existingCode = DB::table('product_variants')
            ->where('enterprise_id', $enterpriseId)
            ->where('code', $code)
            ->first();

        if ($mode === 'create') {
            if ($existingCode) {
                throw ValidationException::withMessages([
                    'name' => ['Este Código está sendo utilizado'],
                ]);
            }
        } else {
            if ($existingCode && $existingCode->id !== $variantID) {
                throw ValidationException::withMessages([
                    'name' => ['Este Código está sendo utilizado'],
                ]);
            }
        }
    }
}
