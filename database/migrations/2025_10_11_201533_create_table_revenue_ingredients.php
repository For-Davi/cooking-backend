<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenue_ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('revenue_id');
            $table->foreign('revenue_id')->references('id')
            ->on('revenues')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenue_ingredients');
    }
};
