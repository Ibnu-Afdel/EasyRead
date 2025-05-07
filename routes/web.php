<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use \App\Http\Controllers\ownerProfileController;
use App\Http\Controllers\UserManagementController;
use App\Livewire\BookList;
use App\Livewire\BookShow;
use App\Livewire\MyBookList;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

// --------------------------------   Everybody ---------------------------------------------------------
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');

// --------------------------------   logged out  ---------------------------------------------------------

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [SessionController::class, 'login'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');
});

// --------------------------------   authenticated users  ---------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::post('/books/{book}/borrow', [BookBorrowController::class, 'borrow'])->name('books.borrow');

    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
});

// --------------------------------   Admins ---------------------------------------------------------

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

// --------------------------------   Librarians  ---------------------------------------------------------


Route::middleware(['auth', 'role:librarian'])->group(function () {
    Route::get('/librarian', [LibrarianController::class, 'borrowedBooks'])->name('librarian.borrowed_books');
});

// --------------------------------   Owners  ---------------------------------------------------------

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/profile', [OwnerProfileController::class, 'profile'])->name('owner.profile');
    Route::post('/owner/profile', [ownerProfileController::class, 'update'])->name('owner.profile.update');

    Route::post('/users/{user}/promote', [UserManagementController::class, 'promote'])->name('users.promote');
    Route::post('/users/{user}/demote', [UserManagementController::class, 'demote'])->name('users.demote');
});

// --------------------------------   Owners and librarians  ---------------------------------------------------------


Route::middleware(['auth', 'role:owner, librarian'])->group(function () {
    Route::post('/borrowed-books/{id}/return', [BookBorrowController::class, 'markAsReturned'])->name('borrowed-books.return');
});

// --------------------------------   API  ---------------------------------------------------------
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/books', BookList::class)->name('books.index');
    Route::get('/books/{book}', BookShow::class)->name('books.show');
    Route::get('/my-books', MyBookList::class)->name('my-books.index');
});
