<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Shelf;
use App\Models\Type;
use App\Models\SiteName;
use App\Models\Genre;
use App\Models\BookColor;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'url',
        'type_id',
        'site_name_id',
        'genre_id',
        'finish',
        'read_page',
        'all_page',
        'assessment',
        'book_color_id',
    ];

    // リレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shelves()
    {
        return $this->belongsToMany(Shelf::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function site_name()
    {
        return $this->belongsTo(SiteName::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function book_color()
    {
        return $this->belongsTo(BookColor::class);
    }

}
