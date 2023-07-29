<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->value('id'),
            'name_surname' => $this->faker->name(),
            'advantage' => $this->faker->text(128),
            'flaws' => $this->faker->text(128),
            'message' => $this->faker->text(1024),
            'email' => $this->faker->email(),
            'rating' => rand(1, 5)
        ];
    }
}
