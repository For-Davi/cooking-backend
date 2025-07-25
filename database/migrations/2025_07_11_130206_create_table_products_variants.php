<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->decimal('price', 10, 2);
            $table->decimal('cost', 10, 2)->nullable();
            $table->decimal('stock_quantity', 15, 3)->default(0);
            $table->decimal('min_stock_alert', 15, 3)->default(1);
            $table->string('sku', 50)->nullable();
            $table->unique(['sku', 'enterprise_id']);
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('grid_item_id');
            $table->foreign('grid_item_id')->references('id')->on('grid_items');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('product_colors');
            $table->unsignedBigInteger('enterprise_id');
            $table->foreign('enterprise_id')->references('id')->on('enterprises');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
