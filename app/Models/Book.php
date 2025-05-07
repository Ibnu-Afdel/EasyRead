<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'available_formats' => 'array',
        'subjects' => 'array',
        'bookshelves' => 'array',
    ];


    public function borrowedBy()
    {
        return $this->belongsToMany(User::class, 'borrowed_books');
    }

    public function borrowedBooks()
    {
        return $this->hasMany(BorrowedBook::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'book_user')
            ->withPivot('status', 'last_page', 'started_at', 'finished_at')
            ->withTimestamps();
    }
}
