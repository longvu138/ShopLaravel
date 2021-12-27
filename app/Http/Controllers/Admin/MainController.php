<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $title = 'Trang Quản Trị';
        return view('admin.home')->with(compact('title'));
    }
}
