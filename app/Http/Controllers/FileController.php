<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as LaravelStorage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class FileController extends Controller
{
    protected $storage;

    public function setMetadataForAllFiles()
    {
        $prefix = 'dokumen/';
        $objects = $this->storage->objects(['prefix' => $prefix]);

        foreach ($objects as $object) {
            $object->updateMetadata([
                'contentDisposition' => 'inline',
                'contentType' => 'application/pdf',
            ]);
            echo "Updated metadata for {$object->name()}\n";
        }
    }
    public function uploadFileLocal(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'path' => 'required|string',
        ]);

        $file = $request->file('file');
        $path = rtrim($request->path, '/');
        $fileName = $file->getClientOriginalName();

        if ($path === 'poster') {
            // Simpan ke folder public (tidak perlu encrypt)
            $storedPath = $file->storeAs('public/' . $path, $fileName);
            // URL langsung ke storage symlink (public/storage/...)
            $url = asset('storage/' . $path . '/' . $fileName);
        } else {
            // Simpan ke folder private (perlu encrypt)
            $storedPath = $file->storeAs('private/' . $path, $fileName);
            $encryptedPath = encrypt($storedPath);
            $url = route('getFile', ['path' => $encryptedPath]);
        }

        return response()->json([
            'message' => 'File uploaded successfully',
            'url' => $url,
        ]);
    }


    public function getFile(Request $request, $path)
    {
        // Ensure user is authenticated


        // Try to decrypt the path (for private files)
        try {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }
            $decodedPath = decrypt($path);
        } catch (DecryptException $e) {
            // If decryption fails, assume it's a public path
            $decodedPath = $path;
        }

        // Check if file exists in storage
        if (!LaravelStorage::exists($decodedPath)) {
            abort(404, 'File not found');
        }

        // Return the file response
        return response()->file(storage_path('app/' . $decodedPath));
    }


    public function deleteFile(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string',
            'path' => 'required|string',
        ]);

        $fileName = $request->input('file_name');
        $path = rtrim($request->input('path'), '/') . '/' . $fileName;

        $bucket = $this->storage;
        $object = $bucket->object($path);

        if ($object->exists()) {
            $object->delete();
            return response()->json(['message' => 'File deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'File not found.'], 404);
        }
    }



}
