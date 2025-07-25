<?php

namespace App\Helpers;

use App\Models\ProductLog;

class ProductLogHelper
{
    public static function createLog(int $productID, string $execution, string $description)
    {
        ProductLog::create([
            'product_id' => $productID,
            'execution' => $execution,
            'description' => $description,
        ]);
    }
}
