<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'application' => $this->faker->text(255),
            'brand' => Brand::query()->inRandomOrder()->value('title'),
            'country' => $this->faker->country(),
            'composition' => $this->faker->text(255),
            'gender' => $this->faker->randomElement(['male', 'female', 'child']),
            'catalog_id' => $this->faker->ean8(),
            'warning' => $this->faker->text(255),
            'weight' => $this->faker->text(255),
            'product_id' => Product::query()->inRandomOrder()->value('id')
        ];
    }
}
