<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

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
            'name' => $this->faker->name(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(10,100),
            'price' => $this->faker->numberBetween(1000,100000),
            'created_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
