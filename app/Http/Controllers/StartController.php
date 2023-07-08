<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\MainSlider;
use App\Models\Product;
use Illuminate\Http\Request;

class StartController extends Controller
{
     public function index()
     {
         //return new CategoryCollection(Category::all());
         $main_slides = MainSlider::where('status', 1)->get();
         return response()->json([
             'products'=>Product::query()->where('new', 1)->limit(12)->get(),
             'main_categories' => new CategoryCollection(Category::with('children')->where('parent_id', 0)->get()),
             'main_slides' =>$main_slides
         ]);
     }

     public function menu()
     {
         return new CategoryCollection(Category::with('children')->where('parent_id', 0)->get());
     }
}
