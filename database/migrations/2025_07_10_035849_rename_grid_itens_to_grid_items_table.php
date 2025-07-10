<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('grid_itens', 'grid_items');
    }

    public function down()
    {
        Schema::rename('grid_items', 'grid_itens');
    }
};
