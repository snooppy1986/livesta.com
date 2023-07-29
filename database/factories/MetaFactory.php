<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meta>
 */
class MetaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'page_name' => 'main',
            'title' => 'Main Page',
            'description' => $this->faker->text(128),
            'keywords' => $this->faker->words(10, true)
        ];
    }
}
