<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFile\ImportFileRequest;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductController extends Controller
{
    public function index()
    {
        return view('admin/product/import');
    }

    public function store(ImportFileRequest $request)
    {
        $data = $request->validated();

        Excel::import(new ProductsImport, $data['importFile']);

        return redirect(route('product.index'))->with(['message'=>'Импорт категорий прошел успешно.']);
    }
}
