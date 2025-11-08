<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;   
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // creates a new user automatically
            'total_amount' => $this->faker->randomFloat(2,100,1000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
