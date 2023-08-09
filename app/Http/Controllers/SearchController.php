<?php

namespace App\Http\Controllers;

use App\Http\Filter\ProductFilter;
use App\Http\Requests\Search\SearchRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Traits\GetMeta;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Hydrator\VueMetaHydrator;


class SearchController extends Controller
{
    use GetMeta;
    public function index(SearchRequest $request, VueMetaHydrator $hydrator)
    {
        $data=$request->validated();

        //get meta
        $meta = $this->getMeta($hydrator, 'search');

        if($data['search']){
            $filter = app()->make(ProductFilter::class, ['queryParams'=>array_filter($data)]);
            $products = Product::filter($filter)->paginate(\config('app.limit'), ['*'], 'page', $data['page']);

            $count_product = count($products)
                ? $count_product = $products->total()
                : 0;
            return (new ProductCollection($products))
                ->additional([
                    'count_product' => $count_product
                ]);
        }else{
            return response()->json([
                'products' => null,
                'meta' => $meta
            ]);
        }

    }
}
