<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->bigInteger('stock_quantity')->default(0)->change();

            $table->bigInteger('min_stock_alert')->default(1)->change();
        });
    }

    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->decimal('stock_quantity', 15, 3)->default(0)->change();
            $table->decimal('min_stock_alert', 15, 3)->default(1)->change();
        });
    }
};
