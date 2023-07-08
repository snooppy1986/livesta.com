<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'=>'integer',
            'advantage'=>'string|max:1024|min:2|nullable',
            'flaws'=>'string|max:1024|min:2|nullable',
            'message'=>'string|max:2048|min:2|nullable',
            'name_surname'=>'required|string|max:1024|min:2|nullable',
            'email'=>'required|email|max:255|nullable',
            'rating'=>'integer',
        ]);

        try{
            Review::create($data);
            $response = [
                'status' => 1,
                'message' => 'Відгук створений успішно.'
            ];
        }catch (QueryException $exception){
            $response = [
                'status' => 0,
                'message' => 'Помилка. Спробуйте пізніше.'
            ];
        }

        return response()->json($response);
    }
}
