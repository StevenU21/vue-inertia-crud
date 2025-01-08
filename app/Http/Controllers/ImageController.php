<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Inertia\Response;

class ImageController extends Controller
{
    public function index(): Response
    {
        $images = Image::paginate(10);
        return Inertia::render('Images/Index', compact('images'));
    }

    public function store(ImageRequest $request): RedirectResponse
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $imageName = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $imageName, 'public');

            Image::create([
                'file' => $imageName
            ]);
        }

        return redirect()->route('images.index');
    }
}
