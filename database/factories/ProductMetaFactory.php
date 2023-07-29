<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductMeta>
 */
class ProductMetaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->value('id'),
            'description' => $this->faker->text(128),
            'keywords' => $this->faker->words(10, true)
        ];
    }
}
