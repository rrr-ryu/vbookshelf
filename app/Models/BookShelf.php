<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookShelf extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'book_id',
        'shelf_id',
        'place_num',
    ];
}
