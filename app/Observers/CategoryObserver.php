<?php

namespace App\Observers;

use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //create cache category
        Cache::put('categories:'.$category->id, $category);
        //update cache list categories
        Cache::forget('categories:all');
        Cache::rememberForever('categories:all', function (){
            return new CategoryCollection(Category::where('parent_id', 0)->get());
        });
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //delete cache category
        Cache::forget('categories:'.$category->id);
        //create cache category
        Cache::put('categories:'.$category->id, $category);
        //update cache list categories
        Cache::forget('categories:all');
        Cache::rememberForever('categories:all', function (){
            return new CategoryCollection(Category::where('parent_id', 0)->get());
        });
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //delete cache category
        Cache::forget('categories:'.$category->id);
        //update cache list categories
        Cache::forget('categories:all');
        Cache::rememberForever('categories:all', function (){
            return new CategoryCollection(Category::where('parent_id', 0)->get());
        });
    }

}
