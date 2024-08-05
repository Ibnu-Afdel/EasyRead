<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function borrowedBy()
    {
        return $this->belongsToMany(User::class, 'borrowed_books');
    }

    public function borrowedBooks()
{
    return $this->hasMany(BorrowedBook::class);
}
}
