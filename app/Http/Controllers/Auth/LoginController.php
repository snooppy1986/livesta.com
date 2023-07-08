<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $request->validate([
            'login'=>'required | string | min: 2 | max: 41',
            'password'=> 'required | string | min: 6 | max: 24'
        ]);
        $credentials = $request->only('login', 'password');



        if(Auth::guard('admin')->attempt($credentials)){

            $user = Auth::guard('admin')->user();
            return response()->json([
                'message'=>'Вхід адміністратора успішний',
                'status'=>1,
                'user' => $user
            ]);
        }

        return response()->json([
            'message'=>'Помилка. Логін чи пароль невірний.',
            'status'=>0
        ]);
        /*dd(Auth::guard('web')->attempt($credentials));*/
    }
}
