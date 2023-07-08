<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::resource('start', StartController::class);
Route::resource('category', CategoryController::class);
Route::post("/category", [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{id}', [ProductController::class, 'index'])->name('product.index');
Route::get('/menu', [StartController::class, 'menu'])->name('start.menu');
Route::post('/filter', [CategoryController::class, 'filterList'])->name('product.filter');

Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
Route::post('/user/create', [RegisterController::class, 'create'])->name('user.create');
Route::post('/order/products', [CartController::class, 'getOrderProduct'])->name('order.product');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

Route::post('/callback/store', [CallbackController::class, 'store'])->name('callback.store');

//search
Route::post('/search', [SearchController::class, 'index'])->name('search');


Route::group(['middleware'=>'api', 'namespace' => 'App\Http\Controllers', 'prefix'=>'auth'], function ($router){
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('get-order', [OrderController::class, 'show'])->name('order.show');
    Route::group(['middleware'=> 'jwt.auth'], function (){
        Route::post('get-auth-user', [UserController::class, 'getAuthUser']);
        Route::post('add-user-attr', [UserController::class, 'storeAttributes']);
        Route::patch('update-user/{user}', [UserController::class, 'update']);
    });
});
