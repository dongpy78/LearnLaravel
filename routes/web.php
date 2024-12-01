<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\MustBeLoggedIn;

// User related routes
Route::get('/', [UserController::class, "showCorrectHomepage"])->name('login');
Route::post('/register', [UserController::class, "register"])->middleware('guest');
Route::post('/login', [UserController::class, "login"])->middleware('guest');
Route::post('/logout', [UserController::class, "logout"])->middleware(MustBeLoggedIn::class);

// Blog post related routes
Route::get('/create-post', [PostController::class, "showCreateForm"])->middleware(MustBeLoggedIn::class);
Route::post('/create-post', [PostController::class, "storeNewPost"])->middleware(MustBeLoggedIn::class);
Route::get('/post/{post}', [PostController::class, "viewSinglePost"]); //! Lưu ý không được để khoảng trắng
Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware('can:delete,post');
Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('can:update,post');
Route::put('/post/{post}', [PostController::class, 'actuallyUpdate'])->middleware('can:update,post');



// Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profile']);
