<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Associates the review with a user
            'product_id' => Product::factory(), // Associates the review with a product
            'rating' => $this->faker->numberBetween(1, 5), // Random rating between 1 and 5
            'comment' => $this->faker->paragraph, // Random paragraph as comment
       ];
    }
}
