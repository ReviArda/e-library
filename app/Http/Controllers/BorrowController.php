<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])->latest()->get();
        return view('borrows.index', compact('borrows'));
    }

    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('borrows.create', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
        $book = Book::findOrFail($validated['book_id']);
        if ($book->stock < 1) {
            return back()->withErrors(['book_id' => 'Stok buku habis.']);
        }
        $book->decrement('stock');
        Borrow::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => Carbon::now()->toDateString(),
        ]);
        return redirect()->route('borrows.index')->with('success', 'Buku berhasil dipinjam.');
    }

    public function update(Request $request, Borrow $borrow)
    {
        if ($borrow->returned_at) {
            return back()->withErrors(['returned_at' => 'Buku sudah dikembalikan.']);
        }
        $borrow->book->increment('stock');
        $borrow->update(['returned_at' => Carbon::now()->toDateString()]);
        return redirect()->route('borrows.index')->with('success', 'Buku berhasil dikembalikan.');
    }
} 