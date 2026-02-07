<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products
        $products = Product::all();

        foreach ($products as $product) {
            // Check if inventory already exists for this product
            $existingInventory = Inventory::where('Product_ID', $product->Product_ID)->first();

            if (!$existingInventory) {
                // Create inventory record
                // Random quantity between 5 and 50
                $quantity = rand(5, 50);
                // Threshold at 10 units
                $threshold = 10;

                Inventory::create([
                    'Product_ID' => $product->Product_ID,
                    'Quantity' => $quantity,
                    'Threshold' => $threshold,
                ]);
            }
        }

        $this->command->info('Inventory seeding completed successfully!');
    }
}
