<?php

namespace App\Livewire;

use App\Models\Book;
use Illuminate\Support\Str;
use Livewire\Component;

class BookShow extends Component
{
    public Book $book;

    public function mount(Book $book)
    {
        $this->book = $book;
    }


    public function downloadBook()
    {
        $downloadUrl = $this->book->download_url;

        if ($downloadUrl) {
            if (auth()->check()) {
                auth()->user()->books()->syncWithoutDetaching([$this->book->id => ['status' => 'reading']]);
            }
            return redirect()->away($downloadUrl);
        }

        session()->flash('message_type', 'error');
        session()->flash('message', 'Download URL not available for this book.');
        return null;
    }

    public function render()
    {
        return view('livewire.book-show', [
            'book' => $this->book,
            'Str' => new Str(),
        ]);
    }
}
