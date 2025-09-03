<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run()
    {
        // Users
        DB::table('users')->insert([
            ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 12345678, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => 12345678, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alice Johnson', 'email' => 'alice@example.com', 'password' => 12345678, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bob Brown', 'email' => 'bob@example.com', 'password' => 12345678, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Categories
        DB::table('categories')->insert([
            ['name' => 'Electronics', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Clothing', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Books', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Home', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Products
        DB::table('products')->insert([
            ['name' => 'Laptop', 'price' => 999.99, 'stock' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'T-Shirt', 'price' => 19.99, 'stock' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Novel', 'price' => 14.99, 'stock' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lamp', 'price' => 29.99, 'stock' => 20, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Product Categories
        DB::table('product_categories')->insert([
            ['product_id' => 1, 'category_id' => 1],
            ['product_id' => 2, 'category_id' => 2],
            ['product_id' => 3, 'category_id' => 3],
            ['product_id' => 4, 'category_id' => 4],
        ]);

        // Orders
        // completed // paid
        DB::table('orders')->insert([
            ['user_id' => 1, 'total_amount' => 1019.98, 'status' => 'completed', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'total_amount' => 19.99, 'status' => 'pending', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'total_amount' => 44.98, 'status' => 'completed', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'total_amount' => 14.99, 'status' => 'cancelled', 'created_at' => now(), 'updated_at' => now()],
        ]);


        // Order Items
        DB::table('order_items')->insert([
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 1, 'price' => 999.99],
            ['order_id' => 1, 'product_id' => 2, 'quantity' => 1, 'price' => 19.99],
            ['order_id' => 2, 'product_id' => 2, 'quantity' => 1, 'price' => 19.99],
            ['order_id' => 3, 'product_id' => 3, 'quantity' => 1, 'price' => 14.99],
            ['order_id' => 3, 'product_id' => 4, 'quantity' => 1, 'price' => 29.99],
            ['order_id' => 4, 'product_id' => 3, 'quantity' => 1, 'price' => 14.99],
        ]);

        // Reviews
        // reviews // reviews_
        DB::table('reviews')->insert([
            ['user_id' => 1, 'product_id' => 1, 'rating' => 5, 'comment' => 'Great laptop!', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'product_id' => 2, 'rating' => 4, 'comment' => 'Nice fit.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'product_id' => 3, 'rating' => 3, 'comment' => 'Good read.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'product_id' => 4, 'rating' => 2, 'comment' => 'Lamp broke quickly.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
