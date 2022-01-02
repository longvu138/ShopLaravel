<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class MenuService
{


    // public function get($parent_id = 1)
    // {
    //     // nếu parent_id 0 (chạy query trong when) nếu parent_id = 1 chạy get all();

    //     return Menu::when($parent_id == 0, function ($query) use ($parent_id) {
    //             $query->where('parent_id', $parent_id);
    //         })->get();
    // }

    // lấy tất cả danh sách Menu

    public function show()
    {
        return Menu::select('name', 'id')
            ->where('parent_id', 0)
            ->orderbyDesc('id')
            ->get();
    }

    
    public function getAll()
    {
        return Menu::orderbyDesc('id')->get();
    }

    // lấy menu cha
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    //Thêm mới
    public function create($request)
    {

        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (int) $request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);

            Session()->flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session()->flash('error', 'Tên danh mục có thể bị trùng bạn vui lòng kiểm tra lại');
            return false;
        }

        return True;
    }

    //Xoá

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        // lấy ra menu với id = id truyền vào
        $menu = Menu::where('id', $id)->first();
        // nếu menu = true
        if ($menu) {
            // xoá menu trong csdl với id  = id truyền vào hoặc id cha = id truyền vào
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function update($menu, $request)
    {   
    
        // Kiểm tra id nếu là chính nó thì không update vào danh muuc con
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int)$request->input('parent_id');
        }

        try {
            $menu->name = (string) $request->input('name');
            $menu->description = (string) $request->input('description');
            $menu->content = (string) $request->input('content');
            $menu->active = (int) $request->input('active');
            $menu->slug = Str::slug($request->input('name'), '-');

            $menu->save();
            Session()->flash('success', 'Cập nhật danh mục thành công');
        } catch (\Exception $err) {
            Session()->flash('error', 'Tên danh mục có thể bị trùng bạn vui lòng kiểm tra lại');
            return false;
        }
        return true;
    }

    // lấy theo id
    public function getId($id)
    {   
        // lấu ra menu vớI id truyền vào active 1
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    // 
    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);

        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(4)
            ->withQueryString();
    }
}
