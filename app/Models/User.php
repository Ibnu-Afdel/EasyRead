<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            //            'is_admin' => 'boolean',
            //            'is_member' => 'boolean',
            //            'is_librarian' => 'boolean',
        ];
    }


    public function borrowdBooks()
    {
        return $this->belongsToMany(Book::class, 'borrowed_books');
    }

    public function borrowedBooks()
    {
        return $this->hasMany(BorrowedBook::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)
            ->withPivot(['status', 'last_page', 'started_at', 'finished_at'])
            ->withTimestamps();
    }

    public function custom_books(): HasMany
    {
        return $this->hasMany(CustomBook::class);
    }
}
