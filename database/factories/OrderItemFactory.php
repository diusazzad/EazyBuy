<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(), // Associates the order item with an order
            'product_id' => Product::factory(), // Associates the order item with a product
            'quantity' => $this->faker->numberBetween(1, 10), // Random quantity between 1 and 10
            'price' => $this->faker->randomFloat(2, 1, 100), // Random price
        ];
    }
}
