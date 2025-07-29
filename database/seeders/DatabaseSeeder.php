<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
   public function run()
{
    $faker = Faker::create();

    // $users = User::factory()->count(10)->create();
    $users = User::get();
    $products = Product::get();

    foreach ($users as $user) {
        foreach ($products as $product) {
            Order::factory()->count(1)->create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }

        // Add 3 comments per user
        for ($i = 0; $i < 1; $i++) {
            Comment::create([
                'user_id' => $user->id,
                'content' => $faker->sentence(),
            ]);
        }
    }
}



}


