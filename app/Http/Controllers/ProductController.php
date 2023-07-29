<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Traits\GetMeta;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Hydrator\VueMetaHydrator;
use Illuminate\Http\Request;
use function Pest\json;
use function Symfony\Component\String\reverse;


class ProductController extends Controller
{
    use GetMeta;
    public function index(Request $request, Category $category, VueMetaHydrator $hydrator)
    {
        //get request data
        $id = $request->id;
        $category_id = $request->category_id ?  $request->category_id : null;
        //get product
        $product = Product::query()
            ->with('attributes', 'brand', 'reviews', 'category', 'meta')
            ->whereId($id)
            ->first();
        /*dd($product->attributes);*/
        //get meta data
        $meta = $this->getMeta($hydrator, null , $product);

        $category = $category_id ? $product->category->where('id', $category_id)->first() : $product->category->first();
        /*dd($category);*/
        //get category parents
        $categories = array_reverse($category->ancestors()->toArray());
        //rating product
        $rating = round($product->reviews->avg('rating'), 1);
        return response()->json([
            'id' => $id,
            'product'=> $product,
            'related_products' => $product->related,
            'rating' => $rating,
            'category'=> $category,
            'categories' => $categories,
            'meta' => $meta
        ]);
    }
}
