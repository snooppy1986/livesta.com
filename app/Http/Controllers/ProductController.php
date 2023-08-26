<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Traits\GetMeta;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Hydrator\VueMetaHydrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use function Pest\json;
use function Symfony\Component\String\reverse;


class ProductController extends Controller
{
    use GetMeta;
    public function index(Request $request, VueMetaHydrator $hydrator)
    {
        //get request data
        $id = $request->id;

        //get product
        $product = Cache::rememberForever('products:'.$id, function () use ($id){
            return new ProductResource(Product::query()
                ->whereId($id)
                ->first());
        });

        //get related product
        $related_products = $product->related;

        //get meta data
        $meta = $this->getMeta($hydrator, null , $product);

        //get category parents
        $categories = $product->category->first()->parent_id ?
            array_reverse($product->category->first()->ancestors()->toArray()) :
            [$product->category->first()];

        array_push($categories, $product->category->first());

        return response()->json([
            'product'=> new ProductResource($product),
            'related_products' => new ProductCollection($related_products),
            'categories' => $categories,
            'meta' => $meta
        ]);
    }
}
