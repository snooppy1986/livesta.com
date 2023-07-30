<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DeliveryOptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::query()->inRandomOrder()->value('id'),
            'type' => $this->faker->randomElement(['newPost', 'ukrPost', 'pickup']),
            'area' => $this->faker->state(),
            'city' => $this->faker->city(),
            'warehouse' => $this->faker->streetAddress(),
            'payment_type' => $this->faker->randomElement(['cash', 'card']),
        ];
    }
}
