<?php

namespace App\Http\Controllers;

use App\Http\Filter\ProductFilter;
use App\Http\Requests\CategoryShowRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Traits\GetMeta;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Hydrator\VueMetaHydrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use function Pest\json;
use function Symfony\Component\String\reverse;

class CategoryController extends Controller
{
    use GetMeta;

    public function show( CategoryShowRequest $request, VueMetaHydrator $hydrator)
    {
        $data = $request->validated();

        $id = $data['id'];

        $category = Category::whereId($id)->first();

        /*get Products */
        $filter = app()->make(ProductFilter::class, ['queryParams'=>array_filter($data)]);
        $products = Product::whereIn('id', $category->ids())
            ->filter($filter)
            ->paginate(\config('app.limit'),
                ['*'], 'page', $data['page']);
        //get other info
        if(count($products)){
            $pr = Product::whereIn('id', $category->ids())
                ->get();
            $price_max = $pr->sortByDesc('price_special')->first();
            $price_min = $pr->sortBy('price_special')->first();
            /*$categories = $category;*/
            $parents = array_reverse($category->ancestors()->toArray());
            $count_product = $pr->count();
        }

        //get meta
        $meta = $this->getMeta($hydrator, null,  $category);

        return response()->json(
            [
                'parents' => isset($parents) ? $parents : null,
                'category' => new CategoryResource($category),
                'products' => $products,
                'price_max' => isset($price_max) ? $price_max->price_special : null,
                'price_min' => isset($price_min) ? $price_min->price_special : null,
                'count_product' => isset($count_product) ? $count_product : null,
                'meta' => $meta
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
        return response()->json($products);
    }


}
