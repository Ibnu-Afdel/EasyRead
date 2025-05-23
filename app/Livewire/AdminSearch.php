<?php

namespace App\Livewire;

use App\Models\CustomBook;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $user = Auth::user();
        $books = CustomBook::with('user')->where('name', 'like', "%{$this->search}%")->simplePaginate(15);
        return view('livewire.admin-search', ['books' => $books, 'user' => $user]);
    }
}
