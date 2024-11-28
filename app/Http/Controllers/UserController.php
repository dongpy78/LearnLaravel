<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showCorrectHomepage()
    {
        if (auth()->check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required',
        ]);
        //! auth() hàm toàn cục trong Laravel dùng để truy cập hệ thống xác thực người dùng.
        //! attempt kiểm tra xem người dùng có trong cơ sở dữ liệu hay k -> true || false
        if (auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return 'Congratulations!!!';
        } else {
            return 'Sorry!!!';
        }
    }
    public function register(Request $request) //! $request chứa tất cả dữ liệu người dùng gửi đến
    {
        $incomingFields = $request->validate([ //! Xác thực dữ liệu 
            //! Rule::unique: kiểm tra xem đã tồn tại hay chưa
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        User::create($incomingFields); //! Lưu thông tin người dùng vào cơ sở dữ liệu
        return 'Hello from register function';
    }
}
