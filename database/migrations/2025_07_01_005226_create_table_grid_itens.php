<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grid_itens', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('enterprise_id');
            $table->foreign('enterprise_id')->references('id')->on('enterprises');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grid_itens');
    }
};
