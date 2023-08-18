<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\Product\ProductResource;
use App\Imports\ProductsImport;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\RelatedProduct;
use App\Models\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    use UploadFile;
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('admin/product/index');
    }

    public function create()
    {
        $products = Product::all();
        $categories = Category::with('children')->where('parent_id', 0)->get();
        $brands = Brand::all(['id', 'title']);

        return view('admin/product/create', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        /*dd($data);*/
        /*create product*/
        $product = Product::create([
            'title'=>$data['title'],
            'content'=>strip_tags($data['about']),
            'code'=>$data['code'],
            'price_balls'=>$data['price_balls'],
            'price_discount'=>$data['price_discount'],
            'price_special' =>$data['price_special'],
            'price_through'=>$data['price_through'],
            'rating'=>$data['rating'],
            'brand_id' => $data['brand_id']
        ]);
        //add relation category
        $product->category()->attach($data['parent_id']);

        /*upload image*/
        if(isset($data['productImage'])){
            $filename = $this->UploadFile($data['productImage'], 370, 450, 'public/images/');

            $product->update([
                'image'=>$filename
            ]);

        }

        /*create product attribute*/
        $product->attributes()->create([
            'application'=>strip_tags($data['application']),
            'country'=>$data['country'],
            'composition'=>strip_tags($data['composition']),
            'gender'=>$data['gender'],
            'catalog_id'=>$data['catalog_id'],
            'warning'=>strip_tags($data['warning']),
            'weight'=>$data['weight'],
        ]);

        /*related product*/
        if(isset($data['related_product']))
            $product->related()->attach($data['related_product']);

        $product->meta()->create([
            'description' => $data['description'],
            'keywords' => $data['keywords']
        ]);

        if($product)
            return redirect(route('product.index'))->with(['message'=>'Успіх! Дані товара змінено успішно.']);
        else
            return back(['message'=>'Помилка! Дані товара не збережено.']);

    }

    public function show(Request $request)
    {
        $product = Product::with('attributes')->where('id', $request->id)->first();
        $attributes = Attribute::where('product_id', $product->id)->first();
        $view = view('admin/elements/_modal_show_product', ['product'=>$product])->render();
        //dd($view);
        return response()->json(['view'=>$view]);

    }

    public function edit(Product $product)
    {
        $categories = Category::with('children')->where('parent_id', 0)->get();
        $products = Product::all();
        $cat_ids = $product->category->pluck('id')->toArray();
        $related_ids = $product->related()->pluck('related_id')->toArray();
        $brands = Brand::all(['id', 'title']);

        return view('admin/product/edit')
            ->with([
                'product' => (new ProductResource($product))->resolve(),
                'categories' => $categories,
                'products' => $products,
                'cat_ids' => $cat_ids,
                'brands' => $brands,
                'related_ids' => $related_ids
            ]);
    }

    public function update(ProductStoreRequest $request, Product $product)
    {
        $data = $request->validated();
        /*update product*/
        $product->update([
            'title'=>$data['title'],
            'content'=>strip_tags($data['about']),
            'code'=>$data['code'],
            'price_balls'=>$data['price_balls'],
            'price_discount'=>$data['price_discount'],
            'price_special' =>$data['price_special'],
            'price_through'=>$data['price_through'],
            'rating'=>$data['rating'],
            'brand_id' => $data['brand_id'],
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        /*upload image*/
        if(isset($data['productImage'])){
            //delete old file
            $remove_file_name = $product['image'];
            Storage::delete('public/images/'.$remove_file_name);

            $filename = $this->UploadFile($data['productImage'], 370, 450, 'public/images/');
            /*update image*/
            $product->update([
                'image' => $filename
            ]);
        }

        /*update product attribute*/
        $product->attributes()->updateOrCreate(
            [
                'product_id' => $product->id
            ],
            [
                'application'=>strip_tags($data['application']),
                'country'=>$data['country'],
                'composition'=>strip_tags($data['composition']),
                'gender'=>$data['gender'],
                'catalog_id'=>$data['catalog_id'],
                'warning'=>strip_tags($data['warning']),
                'weight'=>$data['weight'],
             ]
        );
        /*update category product*/
        if(isset($data['parent_id']))
            $product->category()->sync($data['parent_id']);

        /*related product*/
        if(isset($data['related_product']))
            $product->related()->sync($data['related_product']);


        $product->meta()->updateOrCreate(
            ['product_id' => intval($product->id)],
            [
                'description' => $data['description'],
                'keywords' => $data['keywords']
            ]
        );

        if($product)
            return redirect(route('product.index'))->with(['message'=>'Успіх! Дані товара змінено успішно.']);
        else
            return back(['message'=>'Помилка! Дані товара не збережено.']);
    }

    public function destroy(Product $product)
    {
        if($product){
            /*delete product image*/
            Storage::delete('public/images/'.$product['image']);
            /*delete product*/
            $product->delete();
            return response()->json([
                'status'=>1,
                'title'=>$product->title,
            ]);
        }else{
            return response()->json([
                'status'=>0,
            ]);
        }
    }
}
