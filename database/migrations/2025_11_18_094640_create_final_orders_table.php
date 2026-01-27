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
            $table->foreignId('Customer_ID')->constrained('customers', 'Customer_ID')->onDelete('cascade');
            $table->foreignId('CustomerAddress_ID')->constrained('customer_addresses', 'CustomerAddress_ID')->onDelete('cascade');
            $table->foreignId('CustomerPayment_ID')->constrained('customer_payments', 'CustomerPayment_ID')->onDelete('cascade');
            $table->date('OrderDate');
            $table->decimal('Total_Price', 8, 2);
            $table->enum('Status', ['pending', 'shipped', 'returned']);
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
