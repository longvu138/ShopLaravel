<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $result = $this->cartService->create($request);
        if ($result === false) {
            return redirect()->back();
        }

        return redirect('/carts');
    }

    public function show()
    {   
        $products =$this->cartService->getProduct();
        return view('frontend.carts.list',[
            'title'=>'Danh Sách Giỏ Hàng',
            'products' => $products,
            'carts' => Session::get('carts')
        ]);
    }

    public function update(Request $request) 
    {
        $this->cartService->update($request);
        Session::flash('success', 'Cập nhật giỏ hàng thành công');

        return redirect('/carts');
    }

    public function remove($id=0)
    {
        $this->cartService->remove($id);
        return redirect('/carts');
    }
}
