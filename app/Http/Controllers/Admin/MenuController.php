<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;


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

    public function destroy(Request $request)
    {
        $result =   $this->menuService->destroy($request);
        if ($result) {
            return response()->json([
                "error" => false,
                "message" => "Xoá thành công danh mục"
            ]);
        }

        return response()->json([
            "error" => true,
        ]);
    }

    // kiểm t ra trong menu có id không từ clas Menu
    public function show(Menu $menu)
    {
    
        $title = "Chỉnh Sửa Danh Mục".$menu->name;
        $menu = $menu;
        $menus = $this->menuService->getParent();
        return view('admin.menu.edit')->with(compact('title', 'menu','menus'));
    }


    //Cập nhật

    public function update(Menu $menu, CreateFormRequest $request)
    {   
        // dd($request->toArray());
       $this->menuService->update($menu,$request);
       return redirect('/admin/menus/list');
    }
}   

