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
        $validatedData = $request->validate([
            'beasiswa_id' => 'required|integer',
            'nim' => 'required|string|max:9',
            'file_1' => 'required|file',
            'file_2' => 'required|file',
            'file_3' => 'required|file',
            'file_4' => 'required|file',
            'file_5' => 'required|file',
        ]);


        $pengajuanBeasiswa = PengajuanBeasiswa::create([
            'nim' => $validatedData['nim'],
            'beasiswa_id' => $validatedData['beasiswa_id'],
            'tanggal_pengajuan' => now(),
        ]);

        $fileKeys = ['file_1', 'file_2', 'file_3', 'file_4', 'file_5'];
        foreach ($fileKeys as $fileKey) {
            $file = $request->file($fileKey);


            $fileName = $file->getClientOriginalName();

            $newRequest = new Request();
            $newRequest->files->set('file', $file);
            $newRequest->merge(['path' => 'dokumen']);

            $fileController = new FileController();
            $fileUrl = $fileController->uploadFile($newRequest);

            $newDocumentRequest = new Request([
                'nama_dokumen' => $fileName,
                'link_dokumen' => $fileUrl->getData()->url,
                'pengajuan_beasiswa_id' => $pengajuanBeasiswa->id,
            ]);


            $pengajuanDokumenController = new PengajuanDokumenController();
            $pengajuanDokumenController->store($newDocumentRequest);
        }

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
