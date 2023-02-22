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
        $books = Book::where('user_id', $user->id)->paginate(10);

        // 重複した本があればindexに戻る。フラッシュで重複していることを表示
        if ($exists) {
            return redirect()
            ->route('books.index', compact('books','user', 'shelf'))->with('duplicateMessage', 'すでに追加されています。');
        } 

        // place_numを配列化
        $place_num_array = [];

        foreach ($bookshelves as $bookshelf) {
            $place_num_array[] = $bookshelf->place_num;
        }
        
        // 空いているplace_numを取得して$empty_numとする。
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

        // v.0.0では48まで登録できる
        if ($empty_num >= 49) {
            return redirect()
            ->route('books.index', compact('books','user', 'shelf'))->with('overMessage', '本棚がいっぱいです。');
        }

        // 本棚に１冊もなければplace_num=1で登録
        // １冊以上あれば空いてる取得した$empty_numをplace_numとして登録
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
        return redirect()
        ->route('books.index', compact('books','user', 'shelf'))->with('addShelfMessage', '本棚に追加しました。');
    }

    
}
