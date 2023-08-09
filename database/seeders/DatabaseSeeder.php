<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Callback;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\DeliveryOption;
use App\Models\MainSlider;
use App\Models\Meta;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\RelatedProduct;
use App\Models\Review;
use App\Models\User;
use App\Models\UserAttribute;
use Database\Factories\CartItemFactory;
use Illuminate\Database\Seeder;
use function Symfony\Component\Uid\Factory\create;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(20)->create();
        $first_level_categories = Category::factory(8)
            ->has(Product::factory(rand(2, 5)))
            ->create(['parent_id'=>0]);
        $second_level_categories = Category::factory(20)
            ->has(Product::factory(rand(2, 5)))
            ->create()
            ->each(function ($category) use($first_level_categories){
                $category->update([
                    'parent_id' => $first_level_categories->random(1)->value('id')
                ]);
            });
        $third_level_categories = Category::factory(40)
            ->has(Product::factory(rand(2, 5)))
            ->create()
            ->each(function ($category) use($second_level_categories){
                $category->update([
                    'parent_id' => $second_level_categories->random(1)->value('id')
                ]);
            });
        Attribute::factory(Product::query()->count())->create();
        RelatedProduct::factory(Product::query()->count() * 3)->create();
        Review::factory(Product::query()->count() * 3)->create();

        $products = Product::query()->get();
        $user = User::factory(20)->create();

        Order::factory(20)
            ->has(User::factory(1))
            ->has(Product::factory(2))
            ->create();
        CartItem::factory(40)->create();
        DeliveryOption::factory(Order::query()->count())->create();
        UserAttribute::factory($user->count())->create();
        Callback::factory(10)->create();
        MainSlider::factory(5)->create();
        ProductMeta::factory($products->count())->create();
        Meta::factory(1)->create();
    }
}
