<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Slider\SliderService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function __construct(SliderService $slider, MenuService $menu,  ProductService $product
    )
{
    $this->slider = $slider;
    $this->menu = $menu;
    $this->product = $product;

}

public function index()
{
    return view('frontend.home', [
        'title' => 'Shop Quần Áo',
        'sliders' => $this->slider->show(),
        'menus' => $this->menu->show(),
        'products' => $this->product->get()       
    ]);
}

public function loadProduct(Request $request)
{
    $page = $request->input('page', 0);
        $result = $this->product->get($page);
        if (count($result) != 0) {

            $html = view('frontend.products.list', ['products' => $result ])->render();

            return response()->json([ 'html' => $html ]);
        }

        return response()->json(['html' => '' ]);
}
}
