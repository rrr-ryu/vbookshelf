<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\BookShelf;
use App\Models\Shelf;
use App\Models\BookColor;


class ShelfController extends Controller
{
    public function show(Request $request, $shelf)
    {   
        $user = Auth::user();
        $shelf = Shelf::where('user_id', $user->id)->first();
        $bookshelves = BookShelf::where('shelf_id', $shelf->id)->get();
        $book_colors = BookColor::all();

        //place_numの順番に$book入れて、空いてる番号にはnullを入れる
        $result = array();
        for ($i = 1; $i <= 48; $i++) {
            $bookshelf = $bookshelves->firstWhere('place_num', $i);
            if ($bookshelf) {
                $book = Book::where('id',$bookshelf->book_id)->first();
                $result[$i] = $book;
            } else {
                $result[$i] = null;
            }
        }

        //$resultを4つに分ける
        $group1 = [];
        $group2 = [];
        $group3 = [];
        $group4 = [];

        foreach ($result as $key => $value) {
            if ($key >= 1 && $key <= 12) {
                $group1[] = $value;
            } elseif ($key >= 13 && $key <= 24) {
                $group2[] = $value;
            } elseif ($key >= 25 && $key <= 36) {
                $group3[] = $value;
            } elseif ($key >= 37 && $key <= 48) {
                $group4[] = $value;
            }
        }

       return view('shelves.show', compact('user', 'shelf', 'book_colors', 'group1', 'group2', 'group3', 'group4'));
    }
    
}
