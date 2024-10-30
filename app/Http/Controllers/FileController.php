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
        $request->merge(['path' => $request->path]);

        $request->validate([
            'file' => 'required|file',
            'path' => 'required|string',
        ]);

        $file = $request->file('file');
        $path = $request['path'];
        $filePath = rtrim($path, '/') . '/' . $file->getClientOriginalName();


        $bucket = $this->storage->getBucket();
        $bucket->upload(fopen($file->getPathname(), 'r'), [
            'name' => $filePath,
            'metadata' => [
                'contentDisposition' => 'attachment; filename="' . $file->getClientOriginalName() . '"'
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

        $bucket = $this->storage->getBucket();
        $object = $bucket->object($path);

        if ($object->exists()) {
            $object->delete();
            return response()->json(['message' => 'File deleted successfully.'],200);
        } else {
            return response()->json(['message' => 'File not found.'], 404);
        }
    }

}
