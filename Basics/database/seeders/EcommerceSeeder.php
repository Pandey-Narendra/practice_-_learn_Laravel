<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
// use App\Models\User;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 users
        $users = User::factory(10)->create();

        // Create 10 products
        $products = Product::factory(20)->create();

        // Create Order with Order Items for the random Users
        $orders = Order::factory(20)
                    ->for($users->random())
                    ->has(OrderItem::factory()->count(3))
                    ->create()
        ;

        // Create a post with Comments and Like for random users
        $post = Post::factory(10)
                ->for($users->random())
                ->has(Comment::factory()->count(3))
                ->has(Like::factory()->count(5))
                ->create()
        ;

        // Output success message
        $this->command->info('Fake data for Products, Orders, Posts, Comments, and Likes created successfully!');
    }
}
