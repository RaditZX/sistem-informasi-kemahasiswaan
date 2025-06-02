<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as LaravelStorage;
use Illuminate\Support\Facades\Auth;


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

        // Simpan file ke lokasi private (tidak bisa diakses langsung)
        $storedPath = $file->storeAs('private/' . $path, $file->getClientOriginalName());

        // Enkripsi path untuk keamanan
        $encryptedPath = encrypt($storedPath);

        // Buat URL untuk mengakses file melalui route getFile
        $url = route('getFile', ['path' => $encryptedPath]);

        return response()->json([
            'message' => 'File uploaded successfully',
            'url' => $url,
        ]);
    }


    public function getFile(Request $request, $path)
    {
        // Validasi autentikasi menggunakan middleware
        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $decodedPath = decrypt($path);

        if (!LaravelStorage::exists($decodedPath)) {
            abort(404, 'File not found');
        }

        return response()->file(storage_path('app/' .  $decodedPath));
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
