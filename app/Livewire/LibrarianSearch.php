<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\BorrowedBook;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LibrarianSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $borrowedBooks = BorrowedBook::with('book', 'user')
            ->where('status', 'borrowed')
            ->when($this->search, function ($query) {
                $query->whereHas('book', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                });
            })
            ->simplePaginate(15);

        return view('livewire.librarian-search', ['borrowedBooks' => $borrowedBooks]);
    }
}
