<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function index()
    {
        $user = Auth::guard('web')->user();
        return view('admin/main/index')->with([
            'user'=>$user
        ]);
    }


}
