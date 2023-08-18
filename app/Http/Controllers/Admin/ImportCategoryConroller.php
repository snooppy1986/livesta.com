<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFile\ImportFileRequest;
use App\Imports\CategoriesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportCategoryConroller extends Controller
{
    public function index(){
        return view('admin/category/import');
    }

    public function store(ImportFileRequest $request)
    {
        $data = $request->validated();

        Excel::import(new CategoriesImport, $data['importFile']);

        return redirect(route('category.index'))->with(['message'=>'Импорт категорий прошел успешно.']);
    }
}
