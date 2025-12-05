<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE product_categories 
            CHANGE Image_URL ImageURL VARCHAR(255) NULL AFTER Description
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE product_categories 
            CHANGE ImageURL Image_URL VARCHAR(255) NULL AFTER updated_at
        ");
    }
};
