<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookShelf;
use App\Models\Shelf;
use Illuminate\Support\Facades\Auth;


class BookShelfController extends Controller
{
    public function store(Request $request)
    {   
        $user = Auth::user();
        $book_id = $request->book_id;
        $shelf = Shelf::where('user_id', $user->id)->first();
        $bookshelves = BookShelf::where('shelf_id', $shelf->id)->get();
        $exists = $bookshelves->where('book_id', $book_id)->first();
        if ($exists) {
            $books = Book::where('user_id', $user->id)->paginate(10);
            $shelf = Shelf::where('user_id', $user->id)->first();
            return view('books.index', compact('books','user', 'shelf'));
        } 

        $place_num_array = [];

        foreach ($bookshelves as $bookshelf) {
            $place_num_array[] = $bookshelf->place_num;
        }

    
        $maxIdx = count($place_num_array) - 1;
        if ($maxIdx >= 0) {
            $range = range(1, $place_num_array[$maxIdx]);
            $empty_num = $place_num_array[$maxIdx] + 1;
            foreach ($range as $rangeNo) {
                if (!in_array($rangeNo, $place_num_array)) {
                    $empty_num = $rangeNo;
                    break;
                }
            }
        } else {
            $empty_num = 1;
        }

        if ($bookshelves == []){
            $bookshelf= BookShelf::create([
                'book_id' => $book_id,
                'shelf_id' => $shelf->id,
                'place_num' => 1,
            ]);
        }else{
            $bookshelf= BookShelf::create([
                'book_id' => $book_id,
                'shelf_id' => $shelf->id,
                'place_num' => $empty_num,
            ]);
        }
        $books = Book::where('user_id', $user->id)->paginate(10);
        $shelf = Shelf::where('user_id', $user->id)->first();
        return view('books.index', compact('books','user', 'shelf'));
    }
}
