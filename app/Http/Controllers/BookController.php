<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Genre;
use App\Models\SiteName;
use App\Models\Type;
use App\Models\Shelf;
use App\Models\BookShelf;
use App\Models\BookColor;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index(Request $request)
     {
         $user = Auth::user();
         $title = $request->get('title');
         $books = Book::where('user_id', $user->id)->where('title', 'like', "%{$title}%")->paginate(10);
         $shelf = Shelf::where('user_id', $user->id)->first();
        
        return view('books.index', compact('books','user', 'shelf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $types = Type::all();
        $siteNames = SiteName::all();
        $genres = Genre::all();
        $shelf = Shelf::where('user_id', $user->id)->first();


        return view('books.create', compact('types','siteNames', 'genres', 'shelf'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $shelf = Shelf::where('user_id', $user->id)->first();
        
        $book = Book::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'url' => $request->url,
            'type_id' => $request->type_id, 
            'site_name_id' => $request->site_name_id, 
            'genre_id' => $request->genre_id,
            'finish' => $request->finish,
            'read_page' => $request->read_page,
            'all_page' => $request->all_page,
            'assessment' => $request->assessment,
            'book_color_id' => 1,
        ]);
        // フラッシュメッセージ分岐
        if ($book) {
            $messageKey = 'successMessage';
            $flashMessage = '登録に成功しました！';
        } else {
            $messageKey = 'errorMessage';
            $flashMessage = '登録に失敗しました。';
        }
        // 連続登録用
        if ($request->continue_param == 1) {
            $continue = 1;
            $types = Type::all();
            $siteNames = SiteName::all();
            $genres = Genre::all();
    
            return redirect()
            ->route('books.create', compact('types','siteNames', 'genres', 'continue'))
            ->with($messageKey, $flashMessage);
        }else{
            $books = Book::where('user_id', $user->id)->paginate(10);
            return redirect()
            ->route('books.index', compact('books','user', 'shelf'))
            ->with($messageKey, $flashMessage);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $types = Type::all();
        $siteNames = SiteName::all();
        $genres = Genre::all();
        
        
        return view('books.edit', compact('book','types','siteNames', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        
        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->url = $request->url;
        $book->type_id = $request->type_id; 
        $book->site_name_id = $request->site_name_id;
        $book->genre_id = $request->genre_id;
        $book->finish = $request->finish;
        $book->read_page = $request->read_page;
        $book->all_page = $request->all_page;
        $book->assessment = $request->assessment;
        $book->save();

        $books = Book::where('user_id', $user->id)->paginate(10);
        $shelf = Shelf::where('user_id', $user->id)->first();
        return redirect()
        ->route('books.index', compact('books','user', 'shelf'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $bookshelf = BookShelf::where('book_id', $book->id);
        $book->delete();
        $bookshelf->delete();


        $user = Auth::user();
        $books = Book::where('user_id', $user->id)->paginate(10);
        $shelf = Shelf::where('user_id', $user->id)->first();
        return redirect()
        ->route('books.index', compact('books','user', 'shelf'))->with('deleteMessage', '本を削除しました。');;
    }

    public function color_update(Request $request, $id)
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
        };

        $book = Book::findOrFail($id);
        $book->book_color_id = $request->book_color_id;
        $book->save();
        
        return redirect()
        ->route('shelves.show', compact('user', 'shelf', 'book_colors', 'group1', 'group2', 'group3', 'group4'));
    }
}
