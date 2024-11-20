<?php

namespace App\Http\Controllers;

use App\Models\PengajuanDokumen;
use Illuminate\Http\Request;

class PengajuanDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        return compact('notificationData');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         // Validate the input data
        $validatedData = $request->validate([
            'pengajuan_beasiswa_id' => 'required|integer',
            'nama_dokumen' => 'required|string',
            'link_dokumen' => 'required|string',
        ]);

        // Insert data into the database
        PengajuanDokumen::create([
            'pengajuan_beasiswa_id' => $validatedData['pengajuan_beasiswa_id'],
            'nama_dokumen' => $validatedData['nama_dokumen'],
            'link_dokumen' => $validatedData['link_dokumen'],
        ]);
        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');

        //     $newRequest = new Request();
        //     $newRequest->files->set('file', $file);

        //     $fileController = new FileController();
        //     return $fileController->uploadFile($newRequest);
        // }

        return response()->json(['message' => 'succes'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanDokumen $pengajuanDokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanDokumen $pengajuanDokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanDokumen $pengajuanDokumen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanDokumen $pengajuanDokumen)
    {
        //
    }
}
