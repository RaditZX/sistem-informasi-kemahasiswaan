<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Facades\Firebase;
use Kreait\Firebase\Storage;
use Illuminate\Support\Facades\Storage as LaravelStorage;
use Illuminate\Support\Facades\Response;

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
        $path = $request->path;

        // Simpan file menggunakan Laravel Storage
        $filePath = rtrim($path, '/') . '/' . $file->getClientOriginalName();
        $storedPath = $file->storeAs($path, $file->getClientOriginalName(), 'public');

        // Set Content-Disposition: inline (untuk menampilkan di browser)
        $storage = LaravelStorage::disk('public');
        $storage->setVisibility($storedPath, 'public'); // Set visibility to public (if needed)

        // You can then set Content-Disposition for Firebase Storage or another service if necessary
        $url = asset('storage/' . $storedPath);  // URL to access the file

        return response()->json(['url' => $url]);
    }




    public function viewFile($url)
    {
        // Path to the file in storage
        $filePath = storage_path('app/public/dokumen/' . $url);

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        // Get the MIME type of the file
        $mimeType = mime_content_type($filePath);



        // If it's a PDF, force set the MIME type to application/pdf
        if ($mimeType === 'application/octet-stream' || $mimeType === 'application/pdf') {
            $mimeType = 'application/pdf';  // Override to force PDF type
        }

        // Return the file with 'Content-Disposition' header set to 'inline'
        return Response::make(file_get_contents($filePath), 200, [
            'Content-Type' => $mimeType,  // Set the correct MIME type for the file
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',  // Display inline
        ]);
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
