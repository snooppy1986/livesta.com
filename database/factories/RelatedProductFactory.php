<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelatedProduct>
 */
class RelatedProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'related_id' => Product::query()->inRandomOrder()->value('id'),
            'product_id' => Product::query()->inRandomOrder()->value('id')
        ];
    }
}
