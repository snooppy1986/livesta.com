<?php

namespace App\Http\Controllers;

use App\Http\Requests\Callback\CallbackStoreRequest;
use App\Models\Callback;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function store(CallbackStoreRequest $request)
    {
        $data = $request->validated();
        Callback::create($data);
        return response()->json(['message'=>'Ваш запит відправлено успішно. Ми відповімо вам протягом 24 годин.']);
    }
}
