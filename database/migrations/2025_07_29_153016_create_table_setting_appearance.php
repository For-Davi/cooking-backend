<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setting_appearance', function (Blueprint $table) {
            $table->id();
            $table->boolean('navbar_color_default')->default(1);
            $table->boolean('navbar_icon_color_default')->default(1);
            $table->boolean('side_menu_color_default')->default(1);
            $table->boolean('side_menu_color_default_not_selected_item')->default(1);
            $table->boolean('side_menu_color_default_selected_item')->default(1);
            $table->boolean('side_menu_color_default_not_selected_icon')->default(1);
            $table->boolean('side_menu_color_default_selected_icon')->default(1);
            $table->string('navbar_color_code')->nullable();
            $table->string('navbar_icon_color_code')->nullable();
            $table->string('side_menu_color_code')->nullable();
            $table->string('side_menu_color_code_not_selected_item')->nullable();
            $table->string('side_menu_color_code_selected_item')->nullable();
            $table->string('side_menu_color_code_not_selected_icon')->nullable();
            $table->string('side_menu_color_code_selected_icon')->nullable();
            $table->unsignedBigInteger('enterprise_id');
            $table->foreign('enterprise_id')->references('id')->on('enterprises');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setting_appearance');
    }
};
