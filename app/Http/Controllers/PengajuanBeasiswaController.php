<?php

namespace App\Http\Controllers;

use App\Models\PengajuanBeasiswa;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;

class PengajuanBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.PengajuanBeasiswa.formPengajuan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'beasiswa_id' => 'required|integer',
            'nim' => 'required|string|max:9',
            'file' => 'required|file',
        ]);

        // Insert data into the 'PengajuanBeasiswa' table
        $pengajuanBeasiswa = PengajuanBeasiswa::create([
            'nim' => $validatedData['nim'],
            'beasiswa_id' => $validatedData['beasiswa_id'],
            'tanggal_pengajuan' => now(),
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Get the original file name
        $fileName = $file->getClientOriginalName();

        // Create a new request instance with the file (if needed)
        $newRequest = new Request();
        $newRequest->files->set('file', $file);

        // Call the uploadFile method from FileController
        $fileController = new FileController();
        $fileUrl = $fileController->uploadFile($newRequest); // Assume this returns the uploaded file's URL

        // Insert document data into 'PengajuanDokumen' table (or any other related table)
        $pengajuanDokumenController = new PengajuanDokumenController();
        $pengajuanDokumenController->store([
            'nama_dokumen' => $fileName, // Use the original file name or a different field
            'file_url' => $fileUrl, // The file URL returned from the uploadFile method
            'pengajuan_beasiswa_id' => $pengajuanBeasiswa->id, // Reference the ID of the created 'PengajuanBeasiswa'
        ]);

        // Redirect or return success message
        return redirect()->route('pengajuan.create')->with('success', 'Item created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(PengajuanBeasiswa $pengajuanBeasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanBeasiswa $pengajuanBeasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanBeasiswa $pengajuanBeasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanBeasiswa $pengajuanBeasiswa)
    {
        //
    }
}
