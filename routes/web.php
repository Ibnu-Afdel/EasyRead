<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use \App\Http\Controllers\ownerProfileController;
use App\Http\Controllers\UserManagementController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home' )->name('home');
Route::view('/about', 'about' )->name('about');


Route::middleware('auth')->group(function(){
    Route::controller(BookController::class)->group(function(){
        Route::get('/books/create' , 'create')->name('books.create');
        Route::post('/books' , 'store')->name('books.store');
        Route::get('/books/{book}/edit' , 'edit')
            ->name('books.edit');

        Route::patch('/books/{book}' , 'update')
            ->name('books.update');

        Route::delete('/books/{book}' , 'destroy')
            ->name('books.destroy');

    }) ;
            // Log Out
        Route::delete('/logout' , [SessionController::class , 'destroy' ])->name('logout');
}) ;

Route::middleware('guest')->group(function(){

     // Register
        Route::get('/register' , [RegisterController::class , 'register' ])->name('register');
        Route::post('/register' , [RegisterController::class , 'store' ])->name('register.store');
        // Log In
        Route::get('/login' , [SessionController::class , 'login' ])->name('login');
        Route::post('/login' , [SessionController::class , 'store' ])->name('login.store');
}) ;

Route::controller(BookController::class)->group(function(){
    Route::get('/books' , 'index')->name('books.index');
    Route::get('/books/{book}' , 'show')->name('books.show');
}) ;

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin', 'index')
    ->middleware('admin')
    ->name('admin');
}) ;


Route::controller(LibrarianController::class)->group(function(){
    Route::get('/librarian', 'borrowedBooks')
    ->middleware('librarian')
    ->name('librarian.borrowed_books');
}) ;

Route::post('/books/{book}/borrow', [BookBorrowController::class, 'borrow'])->name('books.borrow');
Route::post('/borrowed-books/{id}/return', [BookBorrowController::class, 'markAsReturned'])
    ->name('borrowed-books.return')
    ->middleware('auth','role:owner,librarian');

Route::middleware(['auth', 'role:owner'])->group(function(){
    Route::get('/owner/profile', [OwnerProfileController::class, 'profile'])->name('owner.profile');
    Route::post('/owner/profile', [ownerProfileController::class, 'update'])->name('owner.profile.update');
});

Route::middleware(['auth', 'role:owner'])->group(function() {
    Route::post('/users/{user}/promote', [UserManagementController::class, 'promote'])->name('users.promote');
    Route::post('/users/{user}/demote', [UserManagementController::class, 'demote'])->name('users.demote');
});
