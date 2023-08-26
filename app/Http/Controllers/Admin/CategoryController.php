<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Imports\CategoriesImport;
use App\Models\Category;
use App\Models\Traits\UploadFile;
use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    use UploadFile;
    public function index()
    {
        $categories = Cache::rememberForever('categories:all', function (){
            return new CategoryCollection(Category::where('parent_id', 0)->get());
        });

        return view('/admin/category/index', ['categories'=> $categories]);
    }

    public function create()
    {
        $categories = Cache::rememberForever('categories:all', function (){
            return new CategoryCollection(Category::where('parent_id', 0)->get());
        });

        return view('admin/category/create', ['categories'=>$categories]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();
        if(isset($data['thumbnail'])){
            $file_name = $this->UploadFile($data['thumbnail'], 70, 80, 'public/images/categories/');

            $data['thumbnail'] = url('storage/images/categories/'.$file_name);
        }

        Category::create($data);

        return redirect(route('category.index'))
            ->with('message', 'Категория добавлена успешно.');
    }

    public function edit(Category $category)
    {
        $categories = Cache::rememberForever('categories:all', function (){
            return new CategoryCollection(Category::where('parent_id', 0)->get());
        });

        return view('admin/category/edit', [
            'category'=>$category,
            'categories'=>$categories
        ]);
    }

    public function update(CategoryStoreRequest $request, Category $category)
    {
        $data = $request->validated();

        if(isset($data['thumbnail'])){
            //delete old file
            Storage::delete('public/images/categories/'.$category->thumbnail);

            $file_name = $this->UploadFile($data['thumbnail'], 70, 80, 'public/images/categories/');
            $data['thumbnail'] = url('storage/images/categories/'.$file_name);
        }

        $category->update($data);

        return redirect(route('category.index'))
            ->with('message', 'Категория изменена успешно.');
    }

    public function destroy(Category $category)
    {
        if(count($category->children)<1){
            //delete thumbnail
            Storage::delete('public/images/categories/'.$category->thumbnail);

            //delete category
            $category->delete();

            return response()->json(['status'=>1, 'title'=>$category->title]);
        }else{
            return response()->json(['status'=>0, 'title'=>$category->title]);
        }

    }
}
