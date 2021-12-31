<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function __construct(SliderService $slider, MenuService $menu,
    )
{
    $this->slider = $slider;
    $this->menu = $menu;

}

public function index()
{
    return view('frontend.home', [
        'title' => 'Shop Quần Áo',
        'sliders' => $this->slider->show(),
        'menus' => $this->menu->show(),
       
    ]);
}
}
