<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $user = Auth::user();
        if (!$user->favorites()->where('book_id', $book->id)->exists()) {
            $user->favorites()->create(['book_id' => $book->id]);
        }
        return back();
    }

    public function destroy(Book $book)
    {
        $user = Auth::user();
        $user->favorites()->where('book_id', $book->id)->delete();
        return back();
    }

    public function index()
    {
        $user = Auth::user();
        $books = $user->favoriteBooks()->get();
        return view('favorites.index', compact('books'));
    }
} 