<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use function Pest\json;
use function Symfony\Component\String\reverse;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        $id = $request->id;
        $product = Product::with('attributes', 'reviews', 'category')->whereId($id)->first();
        //dd($product->category);
        $category_id = $request->category_id ?  $request->category_id : null;
        if($category_id) {
            $category = Category::whereId($category_id)->first();
        }
        else{
            $category = Category::whereId($product->category)->first();
        }

        $categories = array_reverse($category->ancestors()->toArray());

        $relate_products = Product::query()->whereIn('id', $product->related_ids())->orderBy('rating' , 'DESC')->get();
        $rating = round($product->reviews->avg('rating'), 1);
        return response()->json([
            'id' => $id,
            'product'=> $product,
            'related_products' => $relate_products,
            'rating' => $rating,
            'category'=>$category,
            'categories' => $categories
        ]);
    }
}
