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

        if (!User::where('role', 'owner')->exists()) {
            User::create([
                'name' => env('DEFAULT_ADMIN_NAME'),
                'email' => env('DEFAULT_ADMIN_EMAIL'),
                'password' => Hash::make(env('DEFAULT_ADMIN_PASSWORD')),
                'role' => 'owner'
            ]) ;
        }

        // is this even needed, needs more research or even the above protected one
        // Gate::policy(Book::class, BookPolicy::class);

        Gate::define('is-librarian', function(User $user){
            return $user->role === 'librarian' || $user->role === 'admin' || $user->role === 'owner' ;
        }) ;
    }
}
