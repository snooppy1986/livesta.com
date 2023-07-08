<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CategoriesImport;
use App\Models\Category;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\name;
use function PHPUnit\Runner\validate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('children')->where('parent_id', 0)->get();
        /*dd($categories);*/
        return view('/admin/category/index')->with([
            'categories'=> $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('children')->where('parent_id', 0)->get();
        return view('admin/category/create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|min:3|max:255',
            'parent_id'=>'int'
        ]);
        $data['translit']=str_slug($data['title'], '-');
        $data['custom_id']=0;
        Category::create($data);
        return redirect(route('category.index'))->with('message', 'Категория добавлена успешно.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::with('children', 'parent')->where('parent_id', 0)->get();
        /*dd(Category::with( 'parent')->where('id', 412)->get());*/
        return view('admin/category/edit', ['category'=>$category, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title'=>'required|min:3|max:255',
            'parent_id'=>'int'
        ]);
        $data['translit']=str_slug($data['title'], '-');
        Category::where('id', $request->id)->update($data);
        return redirect(route('category.index'))->with('message', 'Категория изменена успешно.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::with('children')->where('id', $request->id)->first();
        if(count($category->children)<1){
            /*$category->delete();*/
            return response()->json(['status'=>1, 'title'=>$category->title]);
        }
        else
            return response()->json(['status'=>0, 'title'=>$category->title]);

    }

    public function import(){
        return view('admin/category/import');
    }

    public function import_action(Request $request)
    {
        if($request->hasFile('importFile')){
            Excel::import(new CategoriesImport, $request->file('importFile'));
        }
        return redirect(route('category.index'))->with(['message'=>'Импорт категорий прошел успешно.']);
    }
}
