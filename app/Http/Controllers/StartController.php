<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\MainSlider\MainSliderCollection;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Category;
use App\Models\MainSlider;
use App\Models\Product;
use App\Models\Traits\GetMeta;
use Butschster\Head\Hydrator\VueMetaHydrator;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;

class StartController extends Controller
{
     use GetMeta;
     public function index(VueMetaHydrator $hydrator)
     {
         $products = Cache::rememberForever('products:main_page', function (){
             return new ProductCollection(Product::query()
                 ->where('new', 1)
                 ->limit(12)
                 ->get());
         });
         /*$products = new ProductCollection(Product::query()
             ->where('new', 1)
             ->limit(12)
             ->get());*/

         $main_categories = Cache::rememberForever('categories:all', function (){
             return new CategoryCollection(Category::where('parent_id', 0)->get());
         });

         $main_slides = Cache::rememberForever('main_sliders:all', function (){
             return new MainSliderCollection(MainSlider::where('status', 1)->get());
         });


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
         $categories = Cache::rememberForever('categories:all', function (){
             return new CategoryCollection(Category::where('parent_id', 0)->get());
         });
         /*dd($categories->pluck('title'));*/
         return $categories;
     }
}
