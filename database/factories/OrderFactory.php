<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'status' => 1,
            'total_amount' =>round( fake()->numberBetween(50, 1000),-1),
            'payment_method' => fake()->randomElement(['online', 'cash on delivery']),
            'address' => fake()->building()
        ];
    }
}
