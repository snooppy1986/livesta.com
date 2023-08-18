<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImportCategoryConroller;
use App\Http\Controllers\Admin\ImportProductController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MainSliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SeoPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/admin-login', [AuthController::class, 'entry'])->name('admin.entry');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
/*admin routes*/
Route::group(['middleware'=>['web', 'admin.role:Admin,Manager'],'prefix'=>'admin'], function ($router){
    Route::get('/', [MainController::class, 'index'])->name('admin.main')/*->middleware('admin.role:Admin,Manager')*/;
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

    Route::get('/category/import', [ImportCategoryConroller::class, 'index'])->name('category.import');
    Route::post('category/import/action', [ImportCategoryConroller::class, 'store'])->name('import.category.store');

    Route::get('category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/create/action', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/delete', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::get('/product/import', [ImportProductController::class, 'index'])->name('product.import');
    Route::post('product/import/store', [ImportProductController::class, 'store'])->name('import.product.store');

    Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/edit/action/{product}', [ProductController::class, 'update'])->name('product.edit.action');
    Route::get('/product/show/', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('options/main-slider', [MainSliderController::class, 'index'])->name('option.main-slider');
    Route::get('options/main-slider/create', [MainSliderController::class, 'create'])->name('main-slider.create');
    Route::post('main-slider/store', [MainSliderController::class, 'store'])->name('main-slider.store');
    Route::get('options/main-slider/edit/{slide}', [MainSliderController::class, 'edit'])->name('main-slider.edit');
    Route::post('main-slider/update/{slide}', [MainSliderController::class, 'update'])->name('main-slider.update');
    Route::post('main-slider/update-status/{slide}', [MainSliderController::class, 'updateStatus'])->name('main-slider.update_status');
    Route::post('main-slider/destroy/{slide}', [MainSliderController::class, 'destroy'])->name('main-slider.destroy');
    //seo info
    Route::get('seo/page', [SeoPageController::class, 'index'])->name('seo.page');
    Route::post('seo/update/{meta}', [SeoPageController::class, 'update'])->name('seo.update');

    Route::get('/admin-logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::get('{page}', [\App\Http\Controllers\MainController::class, 'index'])->where('page', '.*');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
