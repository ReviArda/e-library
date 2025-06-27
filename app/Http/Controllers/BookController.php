<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();
        $genres = Book::whereNotNull('genre')->distinct()->pluck('genre');
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }
        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->q.'%')
                  ->orWhere('author', 'like', '%'.$request->q.'%')
                  ->orWhere('publisher', 'like', '%'.$request->q.'%');
            });
        }
        $books = $query->with('borrows')->get();
        return view('books.index', compact('books', 'genres'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'publisher' => 'nullable|string|max:255',
            'cover' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'genre' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);
        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'publisher' => 'nullable|string|max:255',
            'cover' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'genre' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
} 