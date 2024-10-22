<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        // Validate the file upload
        $request->validate([
            'file' => 'required|file',
        ]);

        // Get the uploaded file
        $file = $request->file('file');
        $filePath = 'uploads/' . $file->getClientOriginalName();

        // Store the file in Google Cloud Storage
        Storage::disk('gcs')->put($filePath, fopen($file->getPathname(), 'r'));

        // Get the file's public URL
        $url = Storage::disk('gcs')->url($filePath);

        return response()->json(['url' => $url]);
    }
}
