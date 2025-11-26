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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('OrderItem_ID');
            $table->foreignId('FinalOrder_ID')->constrained('final_orders', 'FinalOrder_ID')->onDelete('cascade');
            $table->foreignId('Product_ID')->constrained('products', 'Product_ID')->onDelete('cascade');
            $table->integer('Quantity');
            $table->decimal('Unit_Price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
