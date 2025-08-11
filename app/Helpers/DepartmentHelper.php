<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DepartmentHelper
{
    public static function existsDepartment($id, $name, $enterpriseId, $mode)
    {
        $department = DB::table('departments')
            ->where('name', $name)
            ->where('enterprise_id', $enterpriseId)
            ->first();

        if ($mode === 'create') {
            if ($department) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe um departamento igual ou parecido.'],
                ]);
            }
        } else {
            if ($department && $department->id != $id) {
                throw ValidationException::withMessages([
                    'name' => ['Já existe um departamento igual ou parecido.'],
                ]);
            }
        }
    }
}
