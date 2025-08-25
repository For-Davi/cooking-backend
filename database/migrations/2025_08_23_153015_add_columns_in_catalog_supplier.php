<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('supplier_catalog', function (Blueprint $table) {

            $table->dropColumn(['name', 'type']);

       
            $table->unsignedBigInteger('product_variant_id');
            $table->foreign('product_variant_id')->references('id')->on('product_variants');

            $table->decimal('price', 10, 2)->after('supplier_id');

            $table->unique(['supplier_id', 'product_variant_id']);

        });
    }

    public function down(): void
    {
        Schema::table('supplier_catalog', function (Blueprint $table) {
           
            $table->string('name');
            $table->string('type')->after('name');

           
            $table->dropForeign(['product_variant_id']);
            $table->dropColumn('product_variant_id');
            $table->dropColumn('price');
        });
    }
};
