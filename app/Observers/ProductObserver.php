<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //create cache product
        Cache::put('products:'.$product->id, $product);
        //update cache list products
        Cache::forget('products:all');
        Cache::rememberForever('products:all', function (){
            return Product::all()->sortByDesc('status');
        });
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //delete cache product
        Cache::forget('products:'.$product->id);
        //create cache product
        Cache::put('products:'.$product->id, $product);
        //update cache list products
        Cache::forget('products:all');
        Cache::rememberForever('products:all', function (){
            return Product::all()->sortByDesc('status');
        });
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //delete cache product
        Cache::forget('products:'.$product->id);
        //update cache list products
        Cache::forget('products:all');
        Cache::rememberForever('products:all', function (){
            return Product::all()->sortByDesc('status');
        });
    }
}
