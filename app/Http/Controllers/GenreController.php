<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class GenreController extends Controller
{
    public function index(): Response
    {
        $genres = Genre::paginate(5);
        return Inertia::render('Genres/Index', compact('genres'));
    }

    public function create(): Response
    {
        $genre = new Genre();
        return Inertia::render('Genres/Create', compact('genre'));
    }

    public function store(GenreRequest $request): RedirectResponse
    {
        Genre::create($request->validated());

        return redirect()->route('genres.index');
    }

    public function edit(Genre $genre): Response
    {
        return Inertia::render('Genres/Edit', compact('genre'));
    }

    public function update(GenreRequest $request, Genre $genre): RedirectResponse
    {
        $genre->update($request->validated());
        return redirect()->route('genres.index');
    }

    public function show(Genre $genre): Response
    {
        return Inertia::render('Genres/Show', compact('genre'));
    }

    public function destroy(Genre $genre): RedirectResponse
    {
        $genre->delete();
        return redirect()->route('genres.index');
    }
}
