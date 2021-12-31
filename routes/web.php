<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\User\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// route login
 Route::get('admin/user/login', [LoginController::class,'index'])->name('login');
 Route::post('admin/user/login/store', [LoginController::class,'store']);

 //route for admin

 Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        // Route Main
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('main',[MainController::class,'index']);
       
        // Route Menus
        Route::prefix('menus')->group(function () {
            Route::get('add',[MenuController::class,'create']);
            Route::post('add',[MenuController::class,'store']);
            Route::get('list',[MenuController::class,'index']);
            Route::delete('destroy',[MenuController::class,'destroy']);
            // bắt id của để get ra thông tin
            Route::get('edit/{menu}',[MenuController::class,'show']);
            Route::post('edit/{menu}',[MenuController::class,'update']);
        });

        // ROUTE PRODUCT
        Route::prefix('products')->group(function () {
            Route::get('add',[ProductController::class,'create']);
            Route::post('add',[ProductController::class,'store']);
            Route::get('list',[ProductController::class,'index']);
            Route::delete('destroy',[ProductController::class,'destroy']);
            // bắt id của để get ra thông tin
            Route::get('edit/{product}',[ProductController::class,'show']);
            Route::post('edit/{product}',[ProductController::class,'update']);
        });


         #Route Upload
         Route::post('/upload/services', [UploadController::class, 'store']);



    });
  

 });

