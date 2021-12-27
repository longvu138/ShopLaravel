<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Đăng Nhập Hệ Thống';
        return view('admin.user.login')->with(compact('title'));
    }

    public function store(Request $request)
    {
        // dd($request->input());
        $email = $request->input('email');
        $password = $request->input('password');
    

        $validate = [
            'email' => 'required|email:filter',
            'password' => 'min:6|required'
        ];
        $messages = [
            'email.required' => 'Email không được để trống',
            'password.min' => 'Mật khẩu dài hơn 6 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
        ];
        $request->validate($validate, $messages);

        //  kiểm tra đăng nhập
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->route('admin');  
        }
        else{
            session()->flash('msg','Đăng nhập thất bại!! vui lòng kiểm tra tài khoản và mật khẩu');
            return redirect()->back();
        }
    }
}
