<?php

namespace App\Http\Controllers;

use App\Http\Filter\ProductFilter;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use function Pest\json;
use function Symfony\Component\String\reverse;

class CategoryController extends Controller
{
    public function show( Request $request)
    {
        $data = $request->validate([
            'id'=> "nullable|integer",
            'prices' => "nullable|array",
            'page'  => "nullable|integer",
            'sort_type' => "nullable|array",
            'search' => "nullable|string",
        ]);
        $id = $data['id'];

        $category = Category::whereId($id)->first();

        if(count($category->children)){
            $cat_ids = Category::find($id)->descendents()->pluck('id');
            $cat_ids[]=$id;
            $relation = CategoryProduct::query()->whereIn('category_id', $cat_ids)->get()->pluck('product_id');
        }else{
            $relation = CategoryProduct::query()->whereIn('category_id', [$id])->get()->pluck('product_id');
        }

        /*get Products */
        $filter = app()->make(ProductFilter::class, ['queryParams'=>array_filter($data)]);
        /*$products = Product::query()->whereIn('id', $relation)->paginate(3);*/
        $products = Product::whereIn('id', $relation)
            ->filter($filter)
            ->paginate(3, ['*'], 'page', $data['page']);

        if(count($products)){
            $price_max = Product::query()->whereIn('id', $relation)->orderByDesc('price_special')->first()->price_special;
            $price_min = Product::query()->whereIn('id', $relation)->orderBy('price_special')->first()->price_special;
            $categories = Category::with('children')->where('id', $id)->first();
            $parents = array_reverse($category->ancestors()->toArray());
            $count_product = Product::whereIn('id', $relation)
                ->filter($filter)
                ->count();
        }

        /*dd($count_product);*/
        return response()->json(
            [
               /*'id'=>$id,*/
                'parents' => isset($parents) ? $parents : null,
                'category' => $category,
                'categories' => isset($categories) ? $categories->children : null,
                'products' => $products,
                'price_max' => isset($price_max) ? $price_max : null,
                'price_min' => isset($price_min) ? $price_min : null,
                'count_product'=> isset($count_product) ? $count_product : null
            ]
        );
    }

    public function filterList(Request $request)
    {
        $data = $request->validate([
           'prices' => "array"
        ]);

        $category = Category::whereId($request->id)->first();
        $filter = app()->make(ProductFilter::class, ['queryParams'=>array_filter($data)]);
        /*dd($filter);*/
        if(count($category->children)){
            $cat_ids = Category::find($category->id)->descendents()->pluck('id');
            $cat_ids[]=$category->id;
            $relation = CategoryProduct::query()->whereIn('category_id', $cat_ids)->get()->pluck('product_id');
        }else{
            $relation = CategoryProduct::query()->whereIn('category_id', [$category->id])->get()->pluck('product_id');
        }
        $products = Product::whereIn('id', $relation)
            ->filter($filter)
            ->paginate(4);
        /*dd($products);*/
       /* $products = Product::query()
            ->whereIn('id', $relation)
            ->whereBetween('price_special', $data['prices'])
            ->paginate(8);*/
        return response()->json($products);
    }


}
