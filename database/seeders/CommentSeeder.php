<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class CommentSeeder extends Seeder
{
    public function run()
    {
    $faker = Faker::create();
        $user = User::all();

               for ($i = 0; $i < 3; $i++) {
            Comment::create([
                'user_id' => $user->id,
                'content' => $faker->sentence(),
            ]);
        }

    }
}
