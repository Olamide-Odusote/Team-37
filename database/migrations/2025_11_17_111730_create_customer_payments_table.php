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
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id('CustomerPayment_ID');
            $table->foreignId('Customer_ID')->constrained('customers', 'Customer_ID')->onDelete('cascade');
            $table->string('CardHolder_Name');
            $table->string('MaskedCardNumber');
            $table->date('ExpiryDate');
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_payments');
    }
};
