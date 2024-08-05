<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\User;
use App\Policies\BookPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        // is this even needed, needs more research or even the above protected one
        // Gate::policy(Book::class, BookPolicy::class);

        Gate::define('is-librarian', function(User $user){
            return $user->is_librarian || $user->is_admin ;
        }) ;
    }
}
