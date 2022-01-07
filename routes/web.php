<?php

use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\User\LoginController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\MainController as FrontendMainController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
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
        
        //Logout 
        Route::get('/logout', [LoginController::class, 'logout']);

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


         # ROUTE SLIDER
         Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });


         #Route Upload
         Route::post('/upload/services', [UploadController::class, 'store']);

           #Cart
        Route::get('customers', [AdminCartController::class, 'index']);
        Route::get('customers/view/{customer}', [AdminCartController::class, 'show']);
      
    });
  
 });

#Route frontend
Route::get('/',[FrontendMainController::class,'index']);
#LOAD PRODUCT
Route::post('/services/load-product', [FrontendMainController::class,'loadProduct']);
#Route Danh mục
Route::get('danh-muc/{id}-{slug}.html', [FrontendMenuController::class, 'index']);
#Route Sản Phẩm
Route::get('san-pham/{id}-{slug}.html', [FrontendProductController::class, 'index']);
#ROUTE CART
Route::post('add-cart', [CartController::class,'index']);
Route::get('/carts',[CartController::class,'show'] );
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('/carts',[CartController::class,'addCart'] );
Route::get('/tks', [CartController::class,'viewtks']);

