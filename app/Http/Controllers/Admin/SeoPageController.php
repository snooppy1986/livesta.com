<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seo\SeoPageUpdateRequest;
use App\Models\Meta;

class SeoPageController extends Controller
{
    public function index(){
        $data = Meta::where('page_name', 'main')->first();
        return view('admin.seo.index', [
            'data' => $data
        ]);
    }

    public function update(Meta $meta, SeoPageUpdateRequest $request)
    {
        $data = $request->all();
        $meta->update($data);
        return redirect()->back()->with(['message'=>'Оновлення успішне']);
    }
}
