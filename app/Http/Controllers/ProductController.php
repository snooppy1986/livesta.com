<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Hydrator\VueMetaHydrator;
use Illuminate\Http\Request;
use function Pest\json;
use function Symfony\Component\String\reverse;


class ProductController extends Controller
{

    public function index(Request $request, VueMetaHydrator $hydrator)
    {
        $id = $request->id;
        $product = Product::with('attributes', 'reviews', 'category', 'meta')->whereId($id)->first();

        $meta =  Meta::setTitle($product->title)
            ->setFavicon(url('/images/favicon.webp'))
            ->setKeywords($product->meta ? $product->meta->keywords : '')
            ->setDescription($product->meta ? $product->meta->description : '');
        $vue_meta = $hydrator->hydrate($meta);

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
            'category'=> $category,
            'categories' => $categories,
            'meta' => $vue_meta
        ]);
    }
}
