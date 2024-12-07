<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    public function storeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:3000',
        ]);

        $user = auth()->user();
        $filename = $user->id . '-' . uniqid() . ".jpg";

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file("avatar"));
        $imgData = $image->cover(120, 120)->toJpeg();
        Storage::put("public/avatars/" . $filename, $imgData);

        $oldAvatar = $user->avatar;

        $user->avatar = $filename;
        $user->save();

        if ($oldAvatar != "/fallback-avatar.jpg") {
            Storage::delete(str_replace("/storage/", "public/", $oldAvatar));
        }

        return back()->with('success', 'Congrats on the new avatar.');
    }
    public function showAvatarForm()
    {
        return view('avatar-form');
    }
    public function profile(User $user)
    {
        // return view('profile-posts', ['username' => $user->username]);
        return view('profile-posts', [
            'avatar' => $user->avatar,
            'username' => $user->username,
            'posts' => $user->posts()->latest()->get(),
            'postCount' => $user->posts()->count()
        ]);
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out');
    }
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
            return redirect('/')->with('success', 'You have successfully logged in');
        } else {
            return redirect('/')->with('failure', 'Invalid login');
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
        $user = User::create($incomingFields); //! Lưu thông tin người dùng vào cơ sở dữ liệu
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for creating an account');
    }
}
