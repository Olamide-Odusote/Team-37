<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Trigger the bootstrap
$app->bootstrapWith([
    Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
    Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
    Illuminate\Foundation\Bootstrap\RegisterFacades::class,
    Illuminate\Foundation\Bootstrap\RegisterProviders::class,
    Illuminate\Foundation\Bootstrap\BootProviders::class,
]);

try {
    echo "=== ALL USERS ===\n";
    $users = \App\Models\User::all();
    foreach ($users as $user) {
        echo "User {$user->id}: {$user->name} ({$user->email})\n";
        $customer = $user->customer;
        echo "  Customer: " . ($customer ? "ID {$customer->Customer_ID} ({$customer->Name})" : "NOT FOUND") . "\n";
    }
    
    echo "\n=== ALL BASKETS ===\n";
    $baskets = \App\Models\Basket::all();
    foreach ($baskets as $basket) {
        echo "Basket {$basket->Basket_ID} (Customer_ID: {$basket->Customer_ID})\n";
        $products = $basket->basketProducts()->get();
        echo "  Products: " . count($products) . "\n";
        foreach ($products as $item) {
            echo "    - Product {$item->Product_ID}: {$item->Quantity} qty\n";
        }
    }
    
    echo "\n=== TEST: View as User ===\n";
    $user = \App\Models\User::first();
    $customer = $user->customer;
    if ($customer) {
        $basket = \App\Models\Basket::where('Customer_ID', $customer->Customer_ID)->first();
        echo "Found basket: " . ($basket ? $basket->Basket_ID : "NO") . "\n";
        if ($basket) {
            $basket_products = $basket->basketProducts()->with('product')->get();
            echo "Products: " . count($basket_products) . "\n";
            foreach ($basket_products as $item) {
                echo "  - " . $item->product->Name . " x {$item->Quantity}\n";
            }
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
