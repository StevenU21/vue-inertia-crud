<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Inertia\Inertia;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::latest()->paginate(5);
        return Inertia::render('Genres/Index', compact('genres'));
    }

    public function create()
    {
        return Inertia::render('Genres/Create');
    }

    public function store(GenreRequest $request)
    {
        Genre::create($request->validated());

        return redirect()->route('genres.index')->with('success', 'Género Creado.');
    }

    public function show(Genre $genre)
    {
        return Inertia::render('Genres/Show', compact('genre'));
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

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index')->with('success', 'Género Eliminado.');
    }
}
