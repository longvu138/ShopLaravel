<?php

namespace App\Helpers;

class Helper
{

    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        // lấy ra menu cha -> in menu  cha ->  xoá bỏ menu cha khỏi mảng -> lấy id của menu cha query menu con-> in menu con

        foreach ($menus as $key => $menu) {

            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . self::active( $menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/menus/edit/' . $menu->id . '">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm"

                            // truyền vào id cần xoá và hàm xử lý sự kiện xoá
                            
                            onclick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                //chạy xong if xoá đi mảng $menu
                unset($menus[$key]);

                // self chính nó
                $html .= self::menu($menus, $menu->id, $char . '|-- ');
            }
        }

        return $html;
    }

    public static function active($active = 0): string
    {
        // active == 0 là khônmg kích hoạt ngược lại là kích hoạt
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>'
            : '<span class="btn btn-success btn-xs">YES</span>';
    }

}
