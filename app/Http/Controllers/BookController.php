<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CustomBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books.index', ['books' => CustomBook::with('user')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        Gate::authorize('create', $book);


        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
            'BookCover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $attribute['user_id'] = Auth::id();

        if ($request->hasFile('BookCover')) {
            $imagepath = $request->file('BookCover')->store('BookCovers', 'public');
            $attribute['BookCover'] = Storage::url($imagepath);
        } else {
            $attribute['BookCover'] = null;
        }

        CustomBook::create($attribute);

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin');
        } else {
            return redirect()->route('books.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomBook $customBook)
    {

        return view('books.show', ['customBook' => $customBook]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        Gate::authorize('update',  $book);
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomBook $customBook, User $user)
    {
        Gate::authorize('update',  [$customBook, $user]);
        $attribute = $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
            'BookCover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        //        $attribute['user_id'] = Auth::id() ;

        if ($request->hasFile('BookCover')) {
            if ($customBook->BookCover) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $customBook->BookCover));
            }
            $imagepath = $request->file('BookCover')->store('BookCovers', 'public');
            $attribute['BookCover'] = Storage::url($imagepath);
        }
        //        else {
        //            $attribute['BookCover'] = null;
        //        }

        $customBook->update($attribute);

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin', ['book' => $customBook]);
        } else {
            return redirect()->route('books.show', ['book' => $customBook]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomBook $customBook, Request $request)
    {
        Gate::authorize('delete', $customBook);
        if ($customBook->BookCover) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $customBook->BookCover));
        }
        $customBook->delete();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin', ['book' => $customBook]);
        } else {
            return redirect()->route('books.index');
        }
    }
}
