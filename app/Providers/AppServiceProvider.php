<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\User;
use App\Policies\BookPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::policy(Book::class, BookPolicy::class);
    }


    protected $policies = [
        'App\Models\Book' => 'App\Policies\BookPolicy',
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('is-librarian', function (User $user) {
            return $user->role === 'librarian' || $user->role === 'owner';
        });

        Gate::define('update', function (User $user) {
            return $user->role === 'admin' || $user->role === 'owner';
        });
    }
}
