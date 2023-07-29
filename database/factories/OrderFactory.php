<?php

namespace Database\Factories;

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
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'notes' => $this->faker->text(1024),
            'status' => $this->faker->randomElement([0, 1]),
            'total_price' => $this->faker->numberBetween(30, 2000)
        ];
    }
}
