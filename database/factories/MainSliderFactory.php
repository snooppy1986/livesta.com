<?php

namespace Database\Factories;

use App\Models\Product;
use http\Url;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MainSlider>
 */
class MainSliderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image_link' => $this->faker->imageUrl(841, 842),
            'product_link' => url('/product/'.Product::query()->inRandomOrder()->value('id')),
            'title' => $this->faker->title,
            'content' => $this->faker->text(256),
            'status' => $this->faker->randomElement([1, 0])
        ];
    }
}
