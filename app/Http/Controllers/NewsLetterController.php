<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsLetter\NewsLetterStoreRequest;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function index()
    {
        //create data table with newsletter
    }

    public function store(NewsLetterStoreRequest $request)
    {
        $data = $request->validated();
        NewsLetter::create($data);
        return response()->json(['message'=>'Ви підписались на новини нашого магазину.'], 200);
    }
}
