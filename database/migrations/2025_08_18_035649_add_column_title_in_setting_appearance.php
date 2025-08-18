<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('setting_appearance', function (Blueprint $table) {
            $table->boolean('title_page_color_default')->default(1);
            $table->string('title_page_color_code')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('setting_appearance', function (Blueprint $table) {
            $table->boolean('title_page_color_default')->default(1);
            $table->string('title_page_color_code')->nullable();
        });
    }
};
