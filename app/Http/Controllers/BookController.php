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

        $book = new Book();
        $genres = Genre::pluck('id', 'name');
        return Inertia::render('Books/Index', compact('books', 'book', 'genres'));
    }

    public function store(BookRequest $request)
    {
        Book::create($request->validated());
        return redirect()->route('books.index')->with('success', 'Libro Creado.');
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return redirect()->route('books.index')->with('success', 'Libro Actualizado.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Libro Eliminado.');
    }
}
