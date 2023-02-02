<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Genre;
use App\Models\SiteName;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
    {
        $user = Auth::user();
        $books = Book::where('user_id', $user->id)->paginate(10);
        
        return view('books.index', compact('books','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $types = Type::all();
        $siteNames = SiteName::all();
        $genres = Genre::all();


        return view('books.create', compact('types','siteNames', 'genres'));

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
        
        Book::create([
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

        $books = Book::where('user_id', $user->id)->paginate(10);
        return view('books.index', compact('books','user'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
