<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Associates the order with a user
            'order_date' => now(), // Uses the current date
            'total_amount' => $this->faker->randomFloat(2, 1, 10000), // Generates a random total amount
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered']), // Random status
      ];
    }
}
