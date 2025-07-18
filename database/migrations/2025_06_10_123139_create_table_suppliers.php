<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('cpf')->nullable();
            $table->unsignedBigInteger('cnpj')->nullable();
            $table->string('state_registration')->nullable();
            $table->string('municipal_registration')->nullable();
            $table->string('phone')->nullable();
            $table->string('site')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('cep')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('number')->nullable();
            $table->integer('active')->default(1);
            $table->unsignedBigInteger('supplier_category_id')->nullable();
            $table->foreign('supplier_category_id')->references('id')->on('supplier_categories');
            $table->unsignedBigInteger('enterprise_id');
            $table->foreign('enterprise_id')->references('id')->on('enterprises');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
