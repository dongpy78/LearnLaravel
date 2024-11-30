<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //! Điều này cho phép chèn các trường title, body, và user_id vào cơ sở dữ liệu mà không gặp phải lỗi bảo mật.
    protected $fillable = ['title', 'body', 'user_id'];


    public function user()
    { //! Lấy hết thông tin của bảng users
        return $this->belongsTo(User::class, 'user_id');
    }
}
