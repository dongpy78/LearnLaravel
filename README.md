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

## View and Blade

Đường dẫn: /resources/views/.

Trong views: ví dụ tạo file homepage.blade.php.

Gõ "doc" tạo cho ta cấu trúc html.

```sh

```
