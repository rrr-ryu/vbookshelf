<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class BookColor extends Model
{
    use HasFactory;

    public function book_color()
    {
        return $this->hasMany(Book::class);
    }
}
