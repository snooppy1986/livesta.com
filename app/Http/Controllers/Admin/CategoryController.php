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

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    use UploadFile;
    public function index()
    {
        $categories = new CategoryCollection(Category::where('parent_id', 0)->get());

        return view('/admin/category/index', ['categories'=> $categories]);
    }

    public function create()
    {
        $categories = new CategoryCollection(Category::where('parent_id', 0)->get());
        return view('admin/category/create', ['categories'=>$categories]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();

        $category = Category::create($data);

        if($data['thumbnail']){
            $file_name = $this->UploadFile($data['thumbnail'], 70, 80, 'public/images/categories/');

            $category->update([
                'thumbnail' => url('storage/images/categories/'.$file_name)
            ]);
        }

        return redirect(route('category.index'))
            ->with('message', 'Категория добавлена успешно.');
    }

    public function edit(Category $category)
    {
        $categories = new CategoryCollection(Category::where('parent_id', 0)
            ->get());

        return view('admin/category/edit', [
            'category'=>$category,
            'categories'=>$categories
        ]);
    }

    public function update(CategoryStoreRequest $request, Category $category)
    {

        $data = $request->validated();

        if($data['thumbnail']){
            //delete old file
            Storage::delete('public/images/main_slider/'.$category->thumbnail);

            $file_name = $this->UploadFile($data['thumbnail'], 70, 80, 'public/images/categories/');
        }

        $category->update([
            'title' => $data['title'],
            'parent_id' => $data['parent_id'],
            'thumbnail' => url('storage/images/categories/'.$file_name),
            'updated_at' => date('Y-m-d G:i:s')
        ]);

        return redirect(route('category.index'))
            ->with('message', 'Категория изменена успешно.');
    }

    public function destroy(Request $request)
    {
        $category = Category::with('children')->where('id', $request->id)->first();

        if(count($category->children)<1)
            return response()->json(['status'=>1, 'title'=>$category->title]);
        else
            return response()->json(['status'=>0, 'title'=>$category->title]);
    }
}
