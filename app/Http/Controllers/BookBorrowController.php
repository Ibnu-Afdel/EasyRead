<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowedBook;
use App\Models\CustomBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookBorrowController extends Controller
{
    public function borrow(Request $request,  CustomBook $customBook)
    {
        $userId = Auth::id();
        $user = Auth::user();
        $currentBorrows = BorrowedBook::where('user_id', $user->id)
            ->where('status', 'borrowed')->count();

        if ($currentBorrows >= 3) {
            return redirect()->back()->with('error', 'You cannot borrow more than 3 books at a time.');
        }

        $alreadyBorrowed = BorrowedBook::where('book_id', $customBook->id)
            ->where('user_id', $userId)
            ->where('status', 'borrowed')
            ->exists();

        if ($alreadyBorrowed) {
            return redirect()->back()->with('error', 'You have already borrowed this book.');
        }

        // Create a new BorrowedBook record
        $borrow = new BorrowedBook();
        $borrow->user_id = $user->id;
        $borrow->custom_book_id = $customBook->id;
        $borrow->borrow_date = now();
        $borrow->due_date = now()->addDays(14);
        $borrow->status = 'borrowed';
        $borrow->save();

        return redirect()->back()->with('success', 'Book borrowed successfully!');
    }

    public function markAsReturned($id)
    {
        $borrow = BorrowedBook::findOrFail($id);
        $borrow->status = 'returned';
        $borrow->return_date = now();
        $borrow->save();

        return redirect()->route('librarian.borrowed_books')->with('success', 'Book marked as returned.');
        // with message not showen yet
    }
}
