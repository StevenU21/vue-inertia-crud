<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\File;
use Inertia\Response;

class FileController extends Controller
{
    public function index(): Response
    {
        $files = File::latest()->paginate(5);
        return Inertia::render('Files/Index', compact('files'));
    }
}
