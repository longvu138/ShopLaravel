<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function create()
    {
        $title= 'Thêm Danh Mục Mới';
       return view('admin.menu.add')->with(compact('title'));
    }
    
    public function store(CreateFormRequest $request)
    {
        dd($request->input());
    }
}
