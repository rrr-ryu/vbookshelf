<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookShelfController;
use App\Http\Controllers\ShelfController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[BookController::class, 'index'])
->middleware(['auth', 'verified'])
->name('books.index');

Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class)->middleware('auth');
    Route::put('/books/{book}/bookshelves', [BookController::class, 'color_update'])->name('books.color_update');
});

Route::middleware('auth')->group(function () {
    Route::get('/shelves/{shelf}',[ShelfController::class, 'show'])->name('shelves.show');
    Route::put('/shelves/{shelf}', [ShelfController::class, 'place_update'])->name('shelves.place_update');
});
Route::middleware('auth')->group(function () {
    Route::post('/bookshelves',[BookShelfController::class, 'store'])->name('bookshelves.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
