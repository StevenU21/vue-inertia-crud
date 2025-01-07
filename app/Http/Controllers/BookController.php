<?php

namespace App\Http\Controllers;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Inertia\Inertia;
use App\Models\Genre;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('genre')->latest()->paginate(5);
        return Inertia::render('Books/Index', compact('books'));
    }

    public function create()
    {
        $book = new Book();
        $genres = Genre::pluck('id', 'name');
        return Inertia::render('Books/Create', compact('book', 'genres'));
    }

    public function store(BookRequest $request)
    {
        Book::create($request->validated());
        return redirect()->route('books.index')->with('success', 'Libro Creado.');
    }

    public function edit(Book $book)
    {
        $book->load('genre');
        $genres = Genre::pluck('id', 'name');
        return Inertia::render('Books/Edit', compact('book', 'genres'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return redirect()->route('books.index')->with('success', 'Libro Actualizado.');
    }

    public function show(Book $book)
    {
        $book->load('genre');
        return Inertia::render('Books/Show', compact('book'));
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Libro Eliminado.');
    }
}
