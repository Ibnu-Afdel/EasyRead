<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowedBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookBorrowController extends Controller
{
    public function borrow(Request $request, Book $book,)
        {
            // first attempt (works but not as the latter one,)
    //         Auth::user()->borrowdBooks()->attach($book->id);
    //     return redirect()->back()->with('success', 'Book borrowed successfully!');

    $book = Book::findOrFail($book->id);
    $userId = Auth::id();

    // Check if the user has already borrowed this book
    $alreadyBorrowed = BorrowedBook::where('book_id', $book->id)
                                    ->where('user_id', $userId)
                                    ->exists();

    if ($alreadyBorrowed) {
        return redirect()->back()->with('error', 'You have already borrowed this book.');
    }

    // Create a new BorrowedBook record
    BorrowedBook::create([
        'book_id' => $book->id,
        'user_id' => $userId,
        'due_date' => now()->addDays(14),
    ]);

    return redirect()->back()->with('success', 'Book borrowed successfully!');
}
}
