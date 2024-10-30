<?php

namespace App\Http\Controllers;

use App\Models\PengajuanBeasiswa;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\FileController;
use App\Models\PengajuanDokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengajuanBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $name = $user->name; 
        $email = $user->email;
        $role_id = $user->role_id;

        return view('pages.Pengajuan.tracking-pengajuan', compact('email', 'name', 'role_id'));
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
    public function show(string $id)
    {
        $pengajuan_beasiswa = PengajuanBeasiswa::findOrFail($id);
        $query = PengajuanDokumen::query();
        $query->where('pengajuan_beasiswa_id', $id );
        $dokumenPengajuan = $query->get();

        return view('pages.PengajuanBeasiswa.formPengajuan', ['pengajuan' => $pengajuan_beasiswa, 'dokumen_pengajauan' => $dokumenPengajuan ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'file_1' => 'nullable|file',
            'file_2' => 'nullable|file',
            'file_3' => 'nullable|file',
            'file_4' => 'nullable|file',
            'file_5' => 'nullable|file',
        ]);

        // Retrieve all documents associated with the given pengajuan_beasiswa_id
        $dokumenPengajuan = PengajuanDokumen::where('pengajuan_beasiswa_id', '=', $id)
                    ->orderBy('dokumen_id', 'asc')
                    ->get();

        if ($dokumenPengajuan->isEmpty()) {
            return redirect()->route('pengajuan.create')->with('failed', 'No documents found for pengajuan id: ' . $id);
        }

        $fileKeys = ['file_1', 'file_2', 'file_3', 'file_4', 'file_5'];
        $fileController = new FileController();

        foreach ($dokumenPengajuan as $index => $dokumen) {
            $fileKey = $fileKeys[$index] ?? null;

            if ($fileKey && $request->hasFile($fileKey)) {

                $deleteRequest = new Request();
                $deleteRequest->merge([
                    'file_name' => $dokumen->nama_dokumen,
                    'path' => 'dokumen'
                ]);
                $fileController->deleteFile($deleteRequest);
                $file = $request->file($fileKey);
                $newRequest = new Request();
                $newRequest->files->set('file', $file);
                $newRequest->merge(['path' => 'dokumen']);
                $fileUrl = $fileController->uploadFile($newRequest);

                $dokumen->nama_dokumen = $file->getClientOriginalName();
                $dokumen->link_dokumen = $fileUrl;
            }
            $dokumen->save();
        }

        return redirect()->route('pengajuan.create')->with('success', 'Documents updated successfully.');
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
