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
        Schema::create('final_orders', function (Blueprint $table) {
            $table->id('FinalOrder_ID');
            $table->foreignId('Customer_ID');
            $table->foreignId('CustomerAddress_ID');
            $table->foreignId('CustomerPayment_ID');
            $table->decimal('Total_Price', 10, 2);
            $table->dateTime('Date');
            $table->enum('Status', ['Pending', 'Shipped', 'Returned'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_orders');
    }
};
