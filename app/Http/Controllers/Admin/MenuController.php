<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;

class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }


    public function create()
    {
        $title = 'Thêm Danh Mục Mới';
        $menus = $this->menuService->getParent();
        return view('admin.menu.add')->with(compact('title', 'menus'));
    }

    public function store(CreateFormRequest $request)
    {
        $this->menuService->create($request);
        return redirect()->back();
    }

    public function index()
    {   
        $title = "Danh Sách Danh Mục";
        $menus = $this->menuService->getAll();
        return view('admin.menu.list')->with(compact('title', 'menus'));
    }
}
