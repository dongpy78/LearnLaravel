<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Các Lệnh Laravel

-   Install composer

```sh
https://getcomposer.org/
```

-   Tạo project laravel

```sh
composer create-project laravel/laravel ourfirstapp
```

-   Run code laravel / http://127.0.0.1:8000/ nên sử dụng địa chỉ này ở local

```sh
php artisan serve
```

## Routes and URLS

-   Thư mực routes của dự án / có 4 file nhưng file web.php chứa tất cả đường dẫn của dự án

```sh
<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return '<h1>Homepage</h1><a href="/about">View the about page</a>';
});

Route::get('/about', function () {
    return '<h1>About Page</h1><a href="/">Back to home</a>';
});
```

## Database

-   Lệnh làm mới lại cơ sở dữ liệu

```sh
php artisan migrate:fresh
```

## Controller

Controller dùng để viết code xử lý logic, api... làm ngắn gọn routes để dễ nhìn hơn.
Controller giống như người quản lý dự án, controller sẽ thực hiện mọi công việc yêu cầu cơ sở dữ liệu cung cấp dữ liệu, đưa ra quyết định, kiểm tra quyền, vv.

-   Tạo file ExampleController bằng dòng lệnh

```sh
php artisan make:controller ExampleController
```

-   Cập nhật lại file routes

```sh
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;

Route::get('/', [ExampleController::class, "homePage"]);
Route::get('/about', [ExampleController::class, "aboutPage"]);
```

-   File ExampleController

```sh
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller {
    public function homePage() {
        return '<h1>Homepage!!!!</h1><a href="/about">View the about page</a>';
    }
    public function aboutPage() {
        return '<h1>About Page!!!!</h1><a href="/">Back to Homepage</a>';
    }
}
```

## Models

Tạo một file model mới bằng dòng lệnh.

```sh
php artisan make:model Post
```

## View and Blade

Đường dẫn: /resources/views/.

Trong views: ví dụ tạo file homepage.blade.php.

Gõ "doc" tạo cho ta cấu trúc html.

```sh

```

## Migrations trong Laravel

Migrations giúp quản lý và thay đổi cấu trúc của cơ sở dữ liệu (database) một cách dễ dàng.
Mỗi lần cần thay đổi cơ sở dữ liệu, thay vì chỉnh sửa thủ công, chỉ cần tạo một file migration để thực hiện các thay đổi này.
public function up(): là nơi định nghĩa các thay đổi muốn thực hiện đối với cơ sở dữ liệu. Đây là nơi tạo bảng, thêm cột, chỉnh sửa dữ liệu.
$table->id(); -> Tạo cột khóa chính (primary key) tự động tăng dần.
$table->timestamps(); -> Tạo hai cột created_at và updated_at để lưu trữ thời gian khi bản ghi được tạo và cập nhật.
$table->string('title'); -> Tạo cột title có kiểu dữ liệu là chuỗi (string), dùng để lưu tiêu đề bài viết.
$table->longText('body'); -> ... lưu nội dung chi tiết của bài viết (vì nội dung có thể dài, nên cần kiểu dữ liệu này).
$table->foreignId('user_id')->constrained()->onDelete('cascade'); -> lưu id, nhận ra khóa ngoại, nếu user xóa bài viết cũng xóa theo.

```sh
php artisan make:migration create_posts_table
php artisan migrate
```
