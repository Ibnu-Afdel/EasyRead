<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function book()
    {
        return $this->belongsTo(CustomBook::class, 'custom_book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
