<?php
namespace App\Helpers;

class Helper{

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
                        <td>' .$menu->active . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td> &nbsp </td>
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
}

?>