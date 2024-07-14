<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Associates the address with a user
            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'zip_code' => $this->faker->postcode,
            'default_address' => $this->faker->boolean, // Random boolean for default_address
      
        ];
    }
}
