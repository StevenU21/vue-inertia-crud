<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Inertia\Inertia;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::paginate(5);
        return Inertia::render('Genres/Index', compact('genres'));
    }

    public function create()
    {
        $genre = new Genre();
        return Inertia::render('Genres/Create', compact('genre'));
    }

    public function store(GenreRequest $request)
    {
        Genre::create($request->validated());

        return redirect()->route('genres.index')->with('success', 'Género Creado.');
    }

    public function edit(Genre $genre)
    {
        return Inertia::render('Genres/Edit', compact('genre'));
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        $genre->update($request->validated());
        return redirect()->route('genres.index')->with('success', 'Género Actualizado.');
    }

    public function show(Genre $genre)
    {
        return Inertia::render('Genres/Show', compact('genre'));
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index')->with('success', 'Género Eliminado.');
    }
}
