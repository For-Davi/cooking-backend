<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TagHelper
{
    public static function existsTag($enterpriseId, $name, $mode, $tagID = null)
    {
        $existingTag = DB::table('tags')
            ->where('enterprise_id', $enterpriseId)
            ->where('name', $name)
            ->first();

        if ($mode === 'create') {
            if ($existingTag) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe uma tag com esse nome'],
                ]);
            }
        } else {
            if ($existingTag && $existingTag->id !== $tagID) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe outra tag com esse nome'],
                ]);
            }
        }
    }
}
