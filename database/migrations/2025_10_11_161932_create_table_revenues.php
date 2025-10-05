<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('time')->default(0);
            $table->bigInteger('portions')->default(1);
            $table->longText('preparation_method');
            $table->boolean('is_favorite')->default(0);

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')
            ->on('categories')
            ->onDelete('set null');

            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')->references('id')
            ->on('images')
            ->onDelete('set null');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
