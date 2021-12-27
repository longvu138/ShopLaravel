<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id',0)->get();
    }

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
}
