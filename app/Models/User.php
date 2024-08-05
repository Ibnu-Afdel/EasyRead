<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
            'is_admin' => 'boolean',
            'is_member' => 'boolean',
            'is_librarian' => 'boolean',
        ];
    }

    public function getRoleAttribute()
    {
        if ($this->is_admin) {
            return 'Admin';
        } elseif ($this->is_librarian) {
            return 'Librarian';
        } elseif ($this->is_member) {
            return 'Member';
        } else {
            return 'Guest';
        }
    }

    public function book()
    {
        return $this->hasMany(Book::class);
    }

    public function borrowdBooks()
    {
        return $this->belongsToMany(Book::class, 'borrowed_books');
    }

    public function borrowedBooks()
{
    return $this->hasMany(BorrowedBook::class);
}
}
