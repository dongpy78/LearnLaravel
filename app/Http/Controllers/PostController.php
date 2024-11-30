<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function storeNewPost(Request $request)
    {
        //! Xác thực dữ liệu người dùng gửi lên đảm bảo title và body không bị bỏ trống
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        //! strip_tags(): Đây là hàm PHP dùng để loại bỏ các thẻ HTML
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        //! Lấy id của người dùng đã đăng nhập
        $incomingFields['user_id'] = auth()->id();

        //! Tạo một bảng ghi mới trong cơ sở dữ liệu posts
        Post::create($incomingFields);

        return "helo";
    }
    public function showCreateForm()
    {
        return view('create-post');
    }
}
