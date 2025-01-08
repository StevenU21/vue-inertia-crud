<?php

namespace App\Http\Controllers;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use App\Models\Genre;
use Inertia\Response;

class BookController extends Controller
{
    public function index(): Response
    {
        $books = Book::with('genre')->latest()->paginate(5);

        $book = new Book();
        $genres = Genre::pluck('id', 'name');
        return Inertia::render('Books/Index', compact('books', 'book', 'genres'));
    }

    public function store(BookRequest $request): RedirectResponse
    {
        Book::create($request->validated());
        return redirect()->route('books.index');
    }

    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());
        return redirect()->route('books.index');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
