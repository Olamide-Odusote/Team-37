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
        Schema::create('basket_products', function (Blueprint $table) {
            $table->id('BasketProduct_ID');
            $table->foreignId('Basket_ID')->constrained('baskets', 'Basket_ID')->onDelete('cascade');
            $table->foreignId('Product_ID')->constrained('products', 'Product_ID')->onDelete('cascade');
            $table->integer('Quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_products');
    }
};
