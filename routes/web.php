<?php

use App\Http\Controllers\Admin\MainController;
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
    Route::get('admin',[MainController::class,'index'])->name('admin');
    Route::get('admin/main',[MainController::class,'index']);
 });

