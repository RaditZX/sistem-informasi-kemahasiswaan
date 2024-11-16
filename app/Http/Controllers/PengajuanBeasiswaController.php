<?php

namespace App\Http\Controllers;

use App\Models\PengajuanDokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanBeasiswa;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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


    public function listPengajuanStaff()
    {

        $listPengajuan = PengajuanBeasiswa::join('beasiswa', 'pengajuan_beasiswa.beasiswa_id', '=', 'beasiswa.id')
            ->join('mahasiswa', 'pengajuan_beasiswa.nim', '=', 'mahasiswa.nim')
            ->join('users', 'mahasiswa.email', '=', 'users.email')
            ->select('beasiswa.*', 'users.nama_depan', 'pengajuan_beasiswa.status', 'pengajuan_beasiswa.tanggal_pengajuan')
            ->get();


        return view('pages.Beasiswa.list-pengaju-beasiswa', compact('listPengajuan'));
    }

    public function create(string $id)
    {
        return view('pages.Beasiswa.pengajuan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'file_1' => 'required|file',
            'file_2' => 'required|file',
            'file_3' => 'required|file',
            'file_4' => 'required|file',
            'file_5' => 'required|file',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create the PengajuanBeasiswa record
            $pengajuanBeasiswa = PengajuanBeasiswa::create([
                'nim' => 123456789,
                'beasiswa_id' => $id,
                'tanggal_pengajuan' => now(),
            ]);

            $fileKeys = ['file_1', 'file_2', 'file_3', 'file_4', 'file_5'];

            foreach ($fileKeys as $fileKey) {
                $file = $request->file($fileKey);

                // Extract file name
                $fileName = $file->getClientOriginalName();

                // Prepare request for file upload
                $newRequest = new Request();
                $newRequest->files->set('file', $file);
                $newRequest->merge(['path' => 'dokumen']);

                // Upload the file
                $fileController = new FileController();
                $fileUrl = $fileController->uploadFile($newRequest);

                // Create PengajuanDokumen record
                PengajuanDokumen::create([
                    'nama_dokumen' => $fileName,
                    'link_dokumen' => $fileUrl->getData()->url,
                    'pengajuan_beasiswa_id' => $pengajuanBeasiswa->id,
                ]);
            }

            DB::commit();

            return redirect()->route('pengajuan.create', ['id' => $id])->with('success', 'Item created successfully.');
        } catch (\Exception $e) {

            DB::rollBack();

            // Optionally log the exception for debugging purposes
            Log::error("Error creating Pengajuan Beasiswa: {$e->getMessage()}", ['exception' => $e]);

            return redirect()->route('pengajuan.create', ['id' => $id])->with('failed', 'Failed to create item. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengajuan_beasiswa = PengajuanBeasiswa::findOrFail($id);
        $query = PengajuanDokumen::query();
        $query->where('pengajuan_beasiswa_id', $id);
        $dokumenPengajuan = $query->get();

        return view('pages.PengajuanBeasiswa.formPengajuan', ['pengajuan' => $pengajuan_beasiswa, 'dokumen_pengajauan' => $dokumenPengajuan]);
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

        DB::beginTransaction();
        try {

            // Retrieve all documents associated with the given pengajuan_beasiswa_id
            $dokumenPengajuan = PengajuanDokumen::where('pengajuan_beasiswa_id', '=', $id)
                ->orderBy('dokumen_id', 'asc')
                ->get();

            if ($dokumenPengajuan->isEmpty()) {
                return redirect()->route('pengajuan.create', ['id' => $id])->with('failed', 'No documents found for pengajuan id: ' . $id);
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

            DB::commit();
            return redirect()->route('pengajuan.create', ['id' => $id])->with('success', 'Documents updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating documents for Pengajuan ID: {$id}", ['exception' => $e]);
            return redirect()->route('pengajuan.create', ['id' => $id])->with('failed', 'Failed to update documents. Please try again later.');
        }
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
