<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\ReviewRequest;
use App\Models\Review;
use Illuminate\Database\QueryException;


class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {
        $data = $request->validated();
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
