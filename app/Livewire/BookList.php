<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class BookList extends Component
{
    use WithPagination;

    public string $search = '';

    protected string $paginationTheme = 'tailwind';


    public function updatingSearch(): void
    {
        $this->resetPage();
    }


    public function read(int $bookId)
    {
        $book = Book::findOrFail($bookId);

        if (auth()->check()) {
            auth()->user()->books()->syncWithoutDetaching([
                $book->id => ['status' => 'reading', 'started_at' =>
                now()]
            ]);
        }

        return redirect()->route('api.books.show', ['book' =>
        $book->id]);
    }


    public function download(int $bookId)
    {
        $book = Book::findOrFail($bookId);

        if ($book->download_url) {

            return redirect()->away($book->download_url);
        }

        session()->flash('message_type', 'error');
        session()->flash('message', 'Download URL not available for this book.');

        return null;
    }

    public function render()
    {
        $query = Book::query();

        if (trim($this->search) !== '') {
            $searchTerm = '%' . trim($this->search) . '%';
            $rawSearchTerm = trim($this->search);

            $query->where(function ($subQuery) use (
                $searchTerm,
                $rawSearchTerm
            ) {
                $subQuery->where('title', 'like', $searchTerm)
                    ->orWhere('author', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm)
                    ->orWhere('subjects', 'like', $searchTerm)
                    ->orWhere('gutenberg_id', '=', $rawSearchTerm);
            });
        }

        $books = $query->latest('id')->paginate(12);

        // Set default value
        $decoded_book = null;

        // Only decode if books exist
        if ($books->count() > 0) {
            // Just use the first book as an example if that's what you meant
            $decoded_book = json_decode($books->first()->available_formats);
        }
        // foreach ($books as $book) {
        //     $decoded_book = json_decode($book->available_formats);
        // }

        return view('livewire.book-list', [
            'books' => $books,
            'decoded_book' => $decoded_book,
        ]);
    }
}
