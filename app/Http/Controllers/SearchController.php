<?php

namespace App\Http\Controllers;

use App\Http\Filter\ProductFilter;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        $data=$request->all();

        if($data['search']){
            $filter = app()->make(ProductFilter::class, ['queryParams'=>array_filter($data)]);
            $products = Product::filter($filter)->get();
            $search_product = Product::filter($filter)->paginate(3, ['*'], 'page', $data['page']);

            if(!count($search_product)){
                $price_max = 0;
                $price_min = 0;
                $count_product = 0;
            }else{

                $price_max = $products->sortBy([
                    ['price_special', 'desc']
                ])->first()->price_special;

                $price_min = $products->sortBy([
                    ['price_special', 'asc']
                ])->first()->price_special;

                $count_product = Product::filter($filter)->count();
            }


            $categories = Category::where('parent_id')->get();
            $search_result = [
                'search_products' => $search_product,
                'price_max' => $price_max,
                'price_min' => $price_min,
                'count_product' => $count_product,
                'categories' => $categories
            ];

            return response()->json($search_result);
        }else{
            return response()->json(null);
        }

    }
}
