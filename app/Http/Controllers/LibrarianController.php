<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibrarianController extends Controller
{
    public function borrowedBooks()
    {
        $borrowedBooks = BorrowedBook::with('book', 'user')->simplePaginate(15);

        return view('librarian.index', compact('borrowedBooks'));
    }
}
