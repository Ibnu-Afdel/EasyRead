<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class BookList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortField = 'id';
    public string $sortDirection = 'desc';

    protected string $paginationTheme = 'tailwind';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function read(int $bookId)
    {
        $book = Book::findOrFail($bookId);

        if (auth()->check()) {
            auth()->user()->books()->syncWithoutDetaching([
                $book->id => ['status' => 'reading', 'started_at' => now()]
            ]);
        }

        return redirect()->route('api.books.show', ['book' => $book->id]);
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
                    ->orWhere('subjects', 'like', $searchTerm);

                if (is_numeric($rawSearchTerm)) {
                    $subQuery->orWhere('gutenberg_id', '=', (int) $rawSearchTerm);
                }
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);
        $books = $query->paginate(12);

        foreach ($books as $book) {
            if (is_string($book->available_formats) && !empty($book->available_formats)) {
                $book->available_formats = json_decode($book->available_formats, true);
            }
        }

        $hasBooks = $books->count() > 0;

        return view('livewire.book-list', [
            'books' => $books,
            'decoded_book' => $hasBooks ? true : null,
        ]);
    }
}
