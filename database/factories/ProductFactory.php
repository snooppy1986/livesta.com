<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(1, true)),
            'image' => $this->faker->imageUrl(200, 200),
            'content' => $this->faker->text(512),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'code' => $this->faker->ean8(),
            'price_balls' => $this->faker->randomFloat(1, 1, 20),
            'price_discount' => $this->faker->numberBetween(10, 300),
            'price_special' => $this->faker->numberBetween(10, 300),
            'price_through' => $this->faker->numberBetween(10, 300),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'new' => $this->faker->randomElement([0, 1])
        ];
    }
}
