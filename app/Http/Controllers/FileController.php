<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Facades\Firebase;
use Kreait\Firebase\Storage;
use Illuminate\Support\Facades\Storage as LaravelStorage;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{
    protected $storage;

    public function __construct()
    {
        $credentialsFile = env('FIREBASE_CREDENTIALS');

        $firebase = (new Factory)->withServiceAccount($credentialsFile);
        $this->storage = $firebase->createStorage()->getBucket();
    }

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


    public function uploadFile(Request $request)
    {
        $request->merge(['path' => $request->path]);

        $request->validate([
            'file' => 'required|file',
            'path' => 'required|string',
        ]);

        $file = $request->file('file');
        $path = $request['path'];
        $filePath = rtrim($path, '/') . '/' . $file->getClientOriginalName();

        $fileMimeType = $file->getMimeType(); // Get the mime type of the file

        // Set Content-Type based on file mime type
        $contentType = $fileMimeType;
        if ($fileMimeType === 'application/pdf') {
            $contentType = 'application/pdf';
        } elseif (strpos($fileMimeType, 'image/') === 0) {
            $contentType = $fileMimeType; // e.g., image/jpeg, image/png, etc.
        } else {
            $contentType = 'application/octet-stream'; // Default for unsupported file types
        }



        $bucket = $this->storage;
        $bucket->upload(fopen($file->getPathname(), 'r'), [
            'name' => $filePath,
            'metadata' => [
                'contentDisposition' => 'inline', // Display in browser
                'contentType' => $contentType, // Set the correct content type for the file
            ],
        ]);

        $url = sprintf(
            'https://firebasestorage.googleapis.com/v0/b/%s/o/%s?alt=media',
            env('FIREBASE_STORAGE_BUCKET'),
            urlencode($filePath)
        );

        return response()->json(['url' => $url]);
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


    public function getPdfUrlFromDatabaseUrl($databaseUrl)
    {
        try {
            // Extract the file path from the URL
            $parsedUrl = parse_url($databaseUrl);

            // Get the path part of the URL (e.g., /dokumen%2Fpraktikum+Design+pattern.pdf)
            $filePathEncoded = $parsedUrl['path'];

            // Decode the URL-encoded file path to get the actual file path (e.g., dokumen/praktikum Design pattern.pdf)
            $filePath = urldecode(ltrim($filePathEncoded, '/'));

            // Initialize Firebase storage
            $firebase = (new Factory)->withServiceAccount(env('FIREBASE_CREDENTIALS'));
            $storage = $firebase->createStorage();

            // Get the reference to the file stored in Firebase Storage
            $bucket = $storage->getBucket();
            $file = $bucket->object('dokumen/er-beasiswa.pdf');

            // Generate a signed URL for the file with inline content disposition and content type
            $url = $file->signedUrl(new \DateTime('1 hour'), [
                'responseDisposition' => 'inline',  // Ensures the file is opened inline
                'responseCacheControl' => 'public, max-age=3600',  // Optional cache control
                'responseContentType' => 'application/pdf'  // Ensures correct content type for PDF
            ]);


            // Return the signed URL for inline display
            return $url;
        } catch (\Exception $e) {
            // Handle errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
