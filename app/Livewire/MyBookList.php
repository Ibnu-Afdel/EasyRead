<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyBookList extends Component
{

    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public $filterStatus = '';
    public $sortBy = 'pivot_updated_at_desc';

    protected $listeners = ['bookStatusChanged' => '$refresh'];

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    }

    public function markAsCompleted(int $bookId)
    {
        $user = Auth::user();
        $bookUser = $user->books()->where('book_id', $bookId)->first();

        if ($bookUser) {
            $user->books()->updateExistingPivot($bookId, [
                'status' => 'completed',
                'finished_at' => now(),
            ]);
            session()->flash('message', "'{$bookUser->title}' marked as completed!");
            $this->dispatch('bookStatusChanged');
        }
    }

    public function markAsReading(int $bookId)
    {
        $user = Auth::user();
        $bookUser = $user->books()->where('book_id', $bookId)->first();

        if ($bookUser) {
            $user->books()->updateExistingPivot($bookId, [
                'status' => 'reading',
                'started_at' => now(),
                'finished_at' => null,
            ]);
            session()->flash('message', "'{$bookUser->title}' moved to reading!");
            $this->dispatch('bookStatusChanged');
        }
    }

    public function removeFromMyBooks(int $bookId)
    {
        $user = Auth::user();
        $book = $user->books()->find($bookId);

        if ($book) {
            $user->books()->detach($bookId);
            session()->flash('message_type', 'error');
            session()->flash('message', "'{$book->title}' removed from My Books.");
            $this->dispatch('bookStatusChanged');
        }
    }
    public function render()
    {
        $user = Auth::user();
        $query = $user->books();

        if (!empty($this->filterStatus)) {
            $query->wherePivot('status', $this->filterStatus);
        }

        switch ($this->sortBy) {
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'author_asc':
                $query->orderBy('author', 'asc');
                break;
            case 'author_desc':
                $query->orderBy('author', 'desc');
                break;
            case 'pivot_started_at_desc':
                $query->orderByPivot('started_at', 'desc');
                break;
            case 'pivot_finished_at_desc':
                $query->orderByPivot('finished_at', 'desc');
                break;
            case 'pivot_updated_at_desc':
            default:
                $query->orderByPivot('updated_at', 'desc');
                break;
        }

        $myBooks = $query->paginate(10);

        return view('livewire.my-book-list', [
            'myBooks' => $myBooks,
        ]);
    }
}
