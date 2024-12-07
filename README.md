<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.phpields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.phpields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.phpields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Các Lệnh Laravel

-   Install composer

```php
https://getcomposer.org/
```

-   Tạo project laravel

```php
composer create-project laravel/laravel ourfirstapp
```

-   Run code laravel / http://127.0.0.1:8000/ nên sử dụng địa chỉ này ở local

```php
php artisan serve
```

## Routes and URLS

-   Thư mực routes của dự án / có 4 file nhưng file web.php chứa tất cả đường dẫn của dự án

```php
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

```php
php artisan migrate:frephp
```

## Controller

Controller dùng để viết code xử lý logic, api... làm ngắn gọn routes để dễ nhìn hơn.
Controller giống như người quản lý dự án, controller sẽ thực hiện mọi công việc yêu cầu cơ sở dữ liệu cung cấp dữ liệu, đưa ra quyết định, kiểm tra quyền, vv.

-   Tạo file ExampleController bằng dòng lệnh

```php
php artisan make:controller ExampleController
```

-   Cập nhật lại file routes

```php
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;

Route::get('/', [ExampleController::class, "homePage"]);
Route::get('/about', [ExampleController::class, "aboutPage"]);
```

-   File ExampleController

```php
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

```php
php artisan make:model Post
```

## View and Blade

Đường dẫn: /resources/views/.

Trong views: ví dụ tạo file homepage.blade.php.

Gõ "doc" tạo cho ta cấu trúc html.

```php

```

## Markdown cho mô tả

Link github tham khảo: https://github.com/adam-p/markdown-here/wiki/markdown-cheatphpeet

```php
    public function viewSinglePost(Post $post) {
        $post['body'] = strip_tags(Str::markdown($post->body), '<p><ul><ol><li><strong><em><h3><br>');
        return view('single-post', ['post' => $post]);
    }

    <div class="body-content">
       {!! $post -> body !!}
    </div>

```

## Migrations trong Laravel

Migrations giúp quản lý và thay đổi cấu trúc của cơ sở dữ liệu (database) một cách dễ dàng.

Mỗi khi cần thay đổi cấu trúc cơ sở dữ liệu, thay vì chỉnh sửa thủ công, bạn chỉ cần tạo một file migration để thực hiện các thay đổi này.

### Các phương thức chính trong Migration

-   **public function up()**: Đây là nơi định nghĩa các thay đổi cần thực hiện đối với cơ sở dữ liệu. Trong phương thức `up`, bạn có thể tạo bảng, thêm cột, chỉnh sửa dữ liệu...

    Ví dụ:

    ```php
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Tạo cột khóa chính (primary key) tự động tăng dần.
            $table->timestamps(); // Tạo hai cột `created_at` và `updated_at` để lưu trữ thời gian tạo và cập nhật bản ghi.
            $table->string('title'); // Tạo cột `title` có kiểu dữ liệu chuỗi (string), dùng để lưu tiêu đề bài viết.
            $table->longText('body'); // Tạo cột `body` lưu trữ nội dung chi tiết của bài viết (kiểu dữ liệu `longText` vì nội dung có thể dài).
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Tạo cột `user_id` làm khóa ngoại, khi người dùng xóa bài viết, bài viết cũng bị xóa theo.
        });
    }
    ```

-   **public function down()**: Phương thức này được sử dụng để quay lại (rollback) những thay đổi trong phương thức `up`. Ví dụ, nếu bạn tạo bảng trong `up()`, thì trong `down()` bạn sẽ xóa bảng đó.

    ```php
    public function down()
    {
        Schema::dropIfExists('posts');
    }
    ```

### Lệnh tạo Migration và chạy Migration

Để tạo một migration, bạn có thể sử dụng lệnh sau:

```php
php artisan make:migration create_posts_table
php artisan migrate
php artisan migrate:rollback
```

## Middleware

Middleware kiểm tra và xử lý yêu cầu HTTP đến trước khi nó được gửi tới các controller hoặc sau khi controller xử lý xong.

```php
php artisan make:middleware MustBeLoggedIn
```

## Policy

Gate::policy(Post::class, PostPolicy::class) chỉ đơn giản là khai báo rằng khi Laravel cần kiểm tra quyền trên mô hình Post, nó sẽ dùng PostPolicy.

PostPolicy là nơi viết các phương thức để kiểm tra quyền (như delete, update) của người dùng đối với bài viết.

```php
php artisan make:policy PostPolicy --model=Post
```

## Permissions Administration

Lệnh này giúp tạo một migration mới để thêm cột isadmin vào bảng users.

```php
php artisan make:migration add_isadmin_to_users_table -- table=users
php artisan migrate
```

## php artisan storage:link

Tạo một symbolic link (liên kết tượng trưng) từ thư mục storage/app/public vào thư mục public/storage trong dự án của bạn.

```php
php artisan storage:link
```

## Cài đặt thư viện Intervention Image

Cài đặt thư viện Intervention Image giúp dễ dàng thao tác và xử lý hình ảnh trong các ứng dụng web.

Khi lệnh hoàn tất, thư viện sẽ được thêm vào trong tệp composer.json của dự án và có thể sử dụng các phương thức của thư viện để làm việc với hình ảnh.

```php
composer require intervention/image
```

## Tạo bảng dữ liệu follows mới

Cài đặt thư viện Intervention Image giúp dễ dàng thao tác và xử lý hình ảnh trong các ứng dụng web.

Khi lệnh hoàn tất, thư viện sẽ được thêm vào trong tệp composer.json của dự án và có thể sử dụng các phương thức của thư viện để làm việc với hình ảnh.

```php
php artisan make:migration create_follows_table
php artisan migrate
php artisan make:model Follow
```
