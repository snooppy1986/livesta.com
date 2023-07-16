<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\MainSlider;
use App\Models\Product;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Hydrator\VueMetaHydrator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Symfony\Component\Console\Command\setDescription;

class StartController extends Controller
{
     public function index(VueMetaHydrator $hydrator)
     {
         //return new CategoryCollection(Category::all());
         $main_slides = MainSlider::where('status', 1)->get();
         $meta_data = \App\Models\Meta::where('page_name', 'main')->first();

         $meta =  Meta::setTitle($meta_data ? $meta_data->title : 'LIVESTA')
             ->setFavicon(url('/images/favicon.webp'))
             ->setKeywords($meta_data ? $meta_data->keywords : '')
             ->setDescription($meta_data ? $meta_data->description : '');

         $vue_meta = $hydrator->hydrate($meta);

         return response()->json([
             'products'=>Product::query()->where('new', 1)->limit(12)->get(),
             'main_categories' => new CategoryCollection(Category::with('children')->where('parent_id', 0)->get()),
             'main_slides' =>$main_slides,
             'meta' => $vue_meta
         ]);
     }

     public function menu()
     {
         return new CategoryCollection(Category::with('children')->where('parent_id', 0)->get());
     }
}
