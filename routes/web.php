<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home' )->name('home');

Route::controller(BookController::class)->group(function(){
    Route::get('/books' , 'index')->name('books.index');
    Route::get('/books/create' , 'create')->name('books.create');
    Route::post('/books' , 'store')->name('books.store');
    Route::get('/books/{book}' , 'show')->name('books.show');
    Route::get('/books/{book}/edit' , 'edit')->name('books.edit');
    Route::patch('/books/{book}' , 'update')->name('books.update');
    Route::delete('/books/{book}' , 'destroy')->name('books.destroy');
}) ;
