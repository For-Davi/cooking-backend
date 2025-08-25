<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_advanced', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->boolean('active')->default(1);
            $table->boolean('allow_coupon')->default(1);
            $table->boolean('allow_discount')->default(1);
            $table->integer('discount_max_percentage')->default(10);
            $table->boolean('has_commission')->default(1);
            $table->integer('commission_percentage')->default(5);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_advanced');
    }
};
