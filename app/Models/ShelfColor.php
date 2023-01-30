<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shelf;

class ShelfColor extends Model
{
    use HasFactory;

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }
}
