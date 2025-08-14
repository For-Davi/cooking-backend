<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('types_account', 'types_receipt');
    }

    public function down(): void
    {
        Schema::rename('types_receipt', 'types_account');
    }
};
