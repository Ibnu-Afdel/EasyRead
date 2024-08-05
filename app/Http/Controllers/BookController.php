<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        return view('books.index', ['books' => Book::all()]) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        Gate::authorize('create', $book);
        
        return view('books.create') ;
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
        ]) ;

        $attribute['user_id'] = Auth::id() ;
        
            if($request->hasFile('BookCover')){
                $imagepath = $request->file('BookCover')->store('BookCovers', 'public');
                $attribute['BookCover'] = Storage::url($imagepath);
            } else{
                $attribute['BookCover'] = null ;
            }

        Book::create($attribute);
        
        $user = auth()->user();
        if ($user->is_admin){
            return redirect()->route('admin');
        } else{
            return redirect()->route('books.index');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book'=> $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $attribute = $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
            'BookCover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $attribute['user_id'] = Auth::id() ;

        if($request->hasFile('BookCover')){
            if ($book->BookCover){
                Storage::disk('public')->delete(str_replace('/storage/', '', $book->BookCover)) ;
            }
            $imagepath = $request->file('BookCover')->store('BookCovers', 'public');
            $attribute['BookCover'] = Storage::url($imagepath);
        } else {
            $attribute['BookCover'] = null; 
        }

        $book->update($attribute);

        $user = auth()->user();

        if ($user->is_admin){
            return redirect()->route('admin', ['book' => $book]);
        } else {
            return redirect()->route('books.show', ['book' => $book]);
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book , Request $request)
    {
            if ($book->BookCover){
                Storage::disk('public')->delete(str_replace('/storage/', '', $book->BookCover)) ;
        }
        $book->delete();

        $user = auth()->user();
        
        if ($user->is_admin){
            return redirect()->route('admin', ['book' => $book]);
        } else {
            return redirect()->route('books.index');
        } 

        
    }
}
