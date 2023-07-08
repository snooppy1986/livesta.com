<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoriesDataTable;
use App\DataTables\ProductsDataTable;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\RelatedProduct;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('admin/product/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $categories = Category::with('children')->where('parent_id', 0)->get();
        return view('admin/product/create', [
            'products'=>$products,
            'categories'=>$categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:2|max:512|string',
            'about'=>'required|max:4096',
            'code'=>'required',
            'price_special'=>'required',
            'price_through'=>'required',
            'application'=>'max:2048',
            'brand'=>'max:2048',
            'country'=>'max:2048',
            'composition'=>'max:2048',
            'weight'=>'max:128'
        ]);
        //dd($request->title);
        /*create product*/
        $product = Product::create([
            'title'=>$request->title,
            'content'=>strip_tags($request->about),
            'category'=>$request->parent_id[0],
            'code'=>$request->code,
            'price_balls'=>$request->price_balls,
            'price_discount'=>$request->price_discount,
            'price_special' =>$request->price_special,
            'price_through'=>$request->price_through,
            'rating'=>$request->rating,
        ]);
        /*upload image*/
        if($request->hasFile('productImage')){
            $extension = $request->file('productImage')->getClientOriginalExtension();
            $name = md5($request->file('productImage')->getClientOriginalName().date('h-m-s')).'.'.$extension;
            $request->productImage->move(storage_path('app/public/images'), $name);
            $product->update([
                'image'=>$name
            ]);

        }
        /*create product attribute*/
        Attribute::create([
            'product_id'=>$product->id,
            'application'=>strip_tags($request->application),
            'brand'=>$request->brand,
            'country'=>$request->country,
            'composition'=>strip_tags($request->composition),
            'gender'=>$request->gender,
            'catalog_id'=>$request->catalog_id,
            'warning'=>strip_tags($request->warning),
            'weight'=>$request->weight,
        ]);

        foreach ($request->parent_id as $cat_id){
            CategoryProduct::create([
                'product_id'=>$product->id,
                'category_id'=>$cat_id,
            ]);
        }

        /*related product*/
        if($request->related_product){
            foreach ($request->related_product as $related_id){
                RelatedProduct::create([
                    'product_id'=>$product->id,
                    'related_id'=>$related_id,
                ]);
            }
        }

        if($product) return redirect(route('product.index'))->with(['message'=>'Успіх! Дані товара змінено успішно.']);
        else return back(['message'=>'Помилка! Дані товара не збережено.']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $product = Product::with('attributes')->where('id', $request->id)->first();
        $attributes = Attribute::where('product_id', $product->id)->first();
        $view = view('admin/elements/_modal_show_product', ['product'=>$product])->render();
        //dd($view);
        return response()->json(['view'=>$view]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::with('children')->where('parent_id', 0)->get();
        $products = Product::all();
        //dd($product->cat_ids()->toArray());
        return view('admin/product/edit', [
            'product'=>$product,
            'categories'=>$categories,
            'products'=>$products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title'=>'required|min:2|max:512|string',
            'about'=>'required|max:4096',
            'code'=>'required',
            'price_special'=>'required',
            'price_through'=>'required',
            'application'=>'max:2048',
            'brand'=>'max:2048',
            'country'=>'max:2048',
            'composition'=>'max:2048',
            'weight'=>'max:128'
        ]);
        /*upload image*/
        if($request->hasFile('productImage')){
            $extension = $request->file('productImage')->getClientOriginalExtension();
            $name = md5($request->file('productImage')->getClientOriginalName().date('h-m-s')).'.'.$extension;
            $request->productImage->move(storage_path('app/public/images'), $name);
            $product->update([
                'image'=>$name
            ]);

        }

        $product->update([
            'title'=>$request->title,
            'content'=>$request->about,
            'category'=>$request->parent_id ? $request->parent_id[0] : 0,
            'code'=>$request->code,
            'price_balls'=>$request->price_balls,
            'price_discount'=>$request->price_discount,
            'price_special' =>$request->price_special,
            'price_through'=>$request->price_through,
            'rating'=>$request->rating,
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        Attribute::where('product_id', $product->id)->update([
            'application'=>$request->application,
            'brand'=>$request->brand,
            'country'=>$request->country,
            'composition'=>$request->composition,
            'gender'=>$request->gender ? $request->gender : 'Унісекс',
            'catalog_id'=>$request->catalog_id,
            'warning'=>$request->warning,
            'weight'=>$request->weight,
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        CategoryProduct::query()->where('product_id', $product->id)->delete();
        if($request->parent_id){
            foreach ($request->parent_id as $cat_id){
                CategoryProduct::create([
                    'product_id'=>$product->id,
                    'category_id'=>$cat_id,
                ]);
            }
        }else{
            CategoryProduct::create([
                'product_id'=>$product->id,
                'category_id'=>0,
            ]);
        }


        /*related product*/
        if($request->related_product){
            RelatedProduct::where('product_id', $product->id)->delete();
            foreach ($request->related_product as $related_id){
                if(!RelatedProduct::query()->where('product_id', $product->id)->where('related_id', $related_id)->first()){
                    RelatedProduct::create([
                        'product_id'=>$product->id,
                        'related_id'=>$related_id,
                    ]);
                }
            }
        }


        if($product) return redirect(route('product.index'))->with(['message'=>'Успіх! Дані товара змінено успішно.']);
        else return back(['message'=>'Помилка! Дані товара не збережено.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = Product::whereId($request->id)->first();
        if($product){
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

    public function import()
    {
        return view('admin/product/import');
    }

    public function import_action(Request $request)
    {
        if($request->hasFile('importFile')){
            Excel::import(new ProductsImport, $request->file('importFile'));
        }
        return redirect(route('product.index'))->with(['message'=>'Импорт категорий прошел успешно.']);
    }
}