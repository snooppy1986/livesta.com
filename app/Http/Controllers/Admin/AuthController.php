<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function entry()
    {
        $user = Auth::guard('web')->user();

        if($user && ($user->role === 'Admin' || $user->role === 'Manager')){
            return redirect()->route('admin.main');
        }
        return view('admin/layouts/adminEntry');
    }
    public function login(LoginRequest $request){
        $request->validated();
        $credentials = $request->only('email', 'password');
        if(Auth::guard('web')->attempt($credentials)){
            $user = Auth::guard('web')->user();
            if($user->role === 'Admin' || $user->role === 'Manager'){
                return redirect()->route('admin.main');
            }else{
                return redirect()->back()->with('error', 'Доступ заборонено');
            }
        }
        return redirect()->back()->with('error', 'Помилка авторизації');
    }

    public function logout(){
        Session::flush();
        Auth::guard('web')->logout();
        return redirect()->route('admin.entry');
    }
}
