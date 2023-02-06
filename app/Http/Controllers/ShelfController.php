<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\BookShelf;
use App\Models\Shelf;


class ShelfController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $shelf = Shelf::where('user_id', $user->id)->first();
       
       return view('shelves.show', compact('user', 'shelf'));
    }
}
