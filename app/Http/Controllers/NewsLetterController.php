<?php

namespace App\Http\Controllers;

use App\DataTables\NewsLetterDataTable;
use App\Http\Requests\NewsLetter\NewsLetterStoreRequest;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function index(NewsLetterDataTable $dataTable)
    {
        return $dataTable->render('admin/newsletter/index');
    }

    public function store(NewsLetterStoreRequest $request)
    {
        $data = $request->validated();
        NewsLetter::create($data);
        return response()->json(['message'=>'Ви підписались на новини нашого магазину.', 'status'=>200]);
    }

    public function update(Request $request, NewsLetter $newsLetter)
    {
        $status = $request->status == 'true' ? 1 : 0;

        $newsLetter->update([
            'status' => $status
        ]);

        $message = $status ? 'Адреса активована.' : 'Адреса деактивована.';
        return response()->json($message);
    }

    public function destroy(NewsLetter $newsLetter)
    {
        if($newsLetter){
            /*delete newsLetter*/
            $newsLetter->delete();
            return response()->json([
                'status'=>1,
                'email'=>$newsLetter->email,
            ]);
        }else{
            return response()->json([
                'status'=>0,
            ]);
        }
    }
}
