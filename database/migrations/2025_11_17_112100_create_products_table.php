<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('Product_ID');
            $table->foreignId('ProductCategory_ID')->constrained('product_categories', 'ProductCategory_ID')->onDelete('cascade');
            $table->string('Name');
            $table->text('Description')->nullable();
            $table->decimal('Price', 8, 2);
            $table->string('Image_URL')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
