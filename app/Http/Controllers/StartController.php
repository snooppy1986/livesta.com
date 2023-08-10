<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Category;
use App\Models\MainSlider;
use App\Models\Product;
use App\Models\Traits\GetMeta;
use Butschster\Head\Hydrator\VueMetaHydrator;

class StartController extends Controller
{
     use GetMeta;
     public function index(VueMetaHydrator $hydrator)
     {
         $products = new ProductCollection(Product::query()
             ->where('new', 1)
             ->limit(12)
             ->get());

         $main_categories = new CategoryCollection(Category::query()
             ->where('parent_id', 0)
             ->get());

         $main_slides = MainSlider::where('status', 1)->get();

         $meta = $this->getMeta($hydrator, 'main');

         return response()->json([
             'products' => $products,
             'main_categories' => $main_categories,
             'main_slides' => $main_slides,
             'meta' => $meta
         ]);
     }

     public function menu()
     {
         return new CategoryCollection(Category::with('children')->where('parent_id', 0)->get());
     }
}
