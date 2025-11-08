<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
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
            'name' => $this->faker->word(),
            'category' => $this->faker->randomElement(['Electronics', 'Clothing', 'Books', 'Toys']),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'stock' => $this->faker->numberBetween(0, 500)
        ];
    }
}
