<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useBootstrap();

        //! Kiểm tra quyền cho model Post 
        Gate::policy(Post::class, PostPolicy::class);

        Gate::define('visitAdminPages', function ($user) {
            return $user->isAdmin === 1;
        });
    }
}
