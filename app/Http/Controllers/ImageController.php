<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Inertia\Response;

class ImageController extends Controller
{
    public function index(): Response
    {
        $images = Image::paginate(10);

        // Add the full path to each image
        $images->getCollection()->transform(function ($image) {
            $image->path_file = asset('storage/' . $image->file);
            return $image;
        });

        return Inertia::render('Images/Index', [
            'items' => $images,
            'csrf_token' => csrf_token(),
        ]);
    }

    public function store(ImageRequest $request): JsonResponse
    {
        $uploadedImages = [];

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $imageName = Str::random(10) . '.' . $file->getClientOriginalExtension();

                $filePath = $file->storeAs('files_images', $imageName, 'public');

                $image = Image::create([
                    'file' => $filePath
                ]);

                $uploadedImages[] = [
                    'id' => $image->id,
                    'file' => $image->file,
                    'path_file' => asset('storage/' . $filePath)
                ];
            }
        }

        return response()->json($uploadedImages);
    }

    public function destroy(Image $image): JsonResponse
    {
        // Delete the file from storage
        Storage::disk('public')->delete($image->file);

        // Delete the image record from the database
        $image->delete();

        return response()->json(['success' => true]);
    }
}
