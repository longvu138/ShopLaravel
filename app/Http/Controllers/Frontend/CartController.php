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
        $products = $this->cartService->getProduct();
        return view('frontend.carts.list', [
            'title' => 'Danh Sách Giỏ Hàng',
            'products' => $products,
            'carts' => Session::get('carts')
        ]);
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);
        // Session::flash('success', 'Cập nhật giỏ hàng thành công');

        return redirect('/carts');
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);
        return redirect('/carts');
    }

    public function addCart(Request $request)
    {



        $validate = [
            'name' => 'required',
            'phone' => 'required|min:10|numeric',
            'address' => 'required',
            'email' => 'required|email',
            'content' => 'required'
        ];
        $messages = [
            'name.required' => "Tên Không Được Để Trống",
            'email.required' => 'Email Không Được Để Trống',
            'email.email' => 'Email không hợp  lệ',
            'address.required' => 'Địa Chỉ Không Được Để Trống',
            'phone.required' => 'Số Điện Thoại không được để trống',
            'phone.min' => 'Số điện thoại không được ít hơn 10 ký tự',
            'phone.numeric' => 'Số điện thoại phải là kiểu số',
            'content.required' => 'Vui lòng nhập vào ghi chú'
        ];
        $request->validate($validate, $messages);

        $this->cartService->addCart($request);

        return redirect('/tks');
    }

    public function viewtks()
    {
        $title = 'Cảm Ơn';
        return view('frontend.carts.tks')->with(compact('title'));
    }
}
