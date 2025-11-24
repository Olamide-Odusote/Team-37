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
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->foreign('Customer_ID')->references('Customer_ID')->on('customers')->onDelete('cascade');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('ProductCategory_ID')->references('ProductCategory_ID')->on('product_categories')->onDelete('cascade');
            $table->foreign('Inventory_ID')->references('Inventory_ID')->on('inventories')->onDelete('cascade');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->foreign('Product_ID')->references('Product_ID')->on('products')->onDelete('cascade');
        });

        Schema::table('inventory_logs', function (Blueprint $table) {
            $table->foreign('Product_ID')->references('Product_ID')->on('products')->onDelete('cascade');
            $table->foreign('Admin_ID')->references('Admin_ID')->on('admins')->onDelete('cascade');
        });

        Schema::table('basket_products', function (Blueprint $table) {
            $table->foreign('Basket_ID')->references('Basket_ID')->on('baskets')->onDelete('cascade');
            $table->foreign('Product_ID')->references('Product_ID')->on('products')->onDelete('cascade');
        });

        Schema::table('final_orders', function (Blueprint $table) {
            $table->foreign('CustomerAddress_ID')->references('CustomerAddress_ID')->on('customer_addresses')->onDelete('cascade');
            $table->foreign('Customer_ID')->references('Customer_ID')->on('customers')->onDelete('cascade');
            $table->foreign('CustomerPayment_ID')->references('CustomerPayment_ID')->on('customer_payments')->onDelete('cascade');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('FinalOrder_ID')->references('FinalOrder_ID')->on('final_orders')->onDelete('cascade');
            $table->foreign('Product_ID')->references('Product_ID')->on('products')->onDelete('cascade');
        });

        Schema::table('return_requests', function (Blueprint $table) {
            $table->foreign('OrderItem_ID')->references('OrderItem_ID')->on('order_items')->onDelete('cascade');
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->foreign('Customer_ID')->references('Customer_ID')->on('customers')->onDelete('cascade');
            $table->foreign('Product_ID')->references('Product_ID')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->dropForeign(['Customer_ID']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['ProductCategory_ID']);
            $table->dropForeign(['Inventory_ID']);
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['Product_ID']);
        });

        Schema::table('inventory_logs', function (Blueprint $table) {
            $table->dropForeign(['Product_ID']);
            $table->dropForeign(['Admin_ID']);
        });

        Schema::table('basket_products', function (Blueprint $table) {
            $table->dropForeign(['Basket_ID']);
            $table->dropForeign(['Product_ID']);
        });

        Schema::table('final_orders', function (Blueprint $table) {
            $table->dropForeign(['CustomerAddress_ID']);
            $table->dropForeign(['Customer_ID']);
            $table->dropForeign(['CustomerPayment_ID']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['FinalOrder_ID']);
            $table->dropForeign(['Product_ID']);
        });

        Schema::table('return_requests', function (Blueprint $table) {
            $table->dropForeign(['OrderItem_ID']);
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->dropForeign(['Customer_ID']);
            $table->dropForeign(['Product_ID']);
        });
    }
};
