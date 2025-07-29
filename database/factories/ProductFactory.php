<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Faker\Provider\bg_BG\PhoneNumber;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'p_name'=> $this ->faker->name(),
            'category'=>$this ->faker->randomElement(['mobile','skincare','cloth']),
            'price'=> $this ->faker->randomFloat(2,100,200),
            'stock'=> $this ->faker->numberBetween(0,100),

        ];
    }
}
