<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;

class FileController extends Controller
{
    protected $storage;

    public function __construct()
    {
        $credentialsFile = env('FIREBASE_CREDENTIALS');

        $firebase = (new Factory)->withServiceAccount($credentialsFile);
        $this->storage = $firebase->createStorage();
    }

    public function uploadFile(Request $request)
    {
        // Validate the file upload
        $request->merge(['path' => $request->path]);

        $request->validate([
            'file' => 'required|file',
            'path' => 'required|string', // Ensure path is validated
        ]);

        // Get the uploaded file
        $file = $request->file('file');
        $path = $request['path'];
        $filePath = rtrim($path, '/') . '/' . $file->getClientOriginalName();

        // Store the file in Firebase Storage
        $bucket = $this->storage->getBucket();
        $bucket->upload(fopen($file->getPathname(), 'r'), [
            'name' => $filePath,
            'metadata' => [
                'contentDisposition' => 'attachment; filename="' . $file->getClientOriginalName() . '"'
            ],
        ]);

        // Get the file's public URL
        $url = sprintf(
            'https://firebasestorage.googleapis.com/v0/b/%s/o/%s?alt=media',
            env('GOOGLE_CLOUD_STORAGE_BUCKET'),
            urlencode($filePath) // URL encode the file path
        );

        return response()->json(['url' => $url]);
    }
}
