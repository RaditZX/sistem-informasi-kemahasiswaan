<?php

namespace App\Http\Controllers;

use App\Models\PengajuanDokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanBeasiswa;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\FileController;
use App\Models\KodeStatus;
use App\Models\Mahasiswa;
use App\Models\Reviewer;
use App\Models\User;

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
        $user_id = Auth::id();
        $nip = null;

        // Check if the user is a Reviewer
        $dataReviewer = Reviewer::join('users', 'reviewer.user_id', '=', 'users.id')
            ->where('user_id', $user_id)
            ->get();

        if (!$dataReviewer->isEmpty()) {
            $nip = $dataReviewer[0]->nip;
        }

        // Fetch Pengajuan based on whether the user is a reviewer or not
        $query = PengajuanBeasiswa::join('beasiswa', 'pengajuan_beasiswa.beasiswa_id', '=', 'beasiswa.id')
            ->join('mahasiswa', 'pengajuan_beasiswa.nim', '=', 'mahasiswa.nim')
            ->join('users', 'mahasiswa.user_id', '=', 'users.id')
            ->select('beasiswa.*', 'users.name', 'pengajuan_beasiswa.id', 'pengajuan_beasiswa.status', 'pengajuan_beasiswa.tanggal_pengajuan');

        if ($nip !== null) {
            // If the user is a reviewer, no additional conditions are needed
            $listPengajuan = $query->get();
        } else {
            // If the user is not a reviewer, restrict results to their own submissions
            $listPengajuan = $query->where('users.id', $user_id)->get();
        }

        return view('pages.Beasiswa.list-pengaju-beasiswa', compact('listPengajuan'));
    }

    public function create(string $id)
    {
        return view('pages.Beasiswa.pengajuan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,string $id)
    {


        $validatedData = $request->validate([
            'file_1' => 'required|file',
            'file_2' => 'required|file',
            'file_3' => 'required|file',
            'file_4' => 'required|file',
            'file_5' => 'required|file',
        ]);


        $pengajuanBeasiswa = PengajuanBeasiswa::create([
            'nim' => 123456789,
            'beasiswa_id' => $id,
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

        return redirect()->route('pengajuan.create',['id'=>$id])->with('success', 'Item created successfully.');
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

    public function showTracking(string $id) {
        // Get data Mahasiswa
        $user_id = Auth::id();
        $userData = User::join('mahasiswa', 'users.id', 'mahasiswa.user_id')
                        ->select('users.email', 'mahasiswa.nim')
                        ->where('users.id', $user_id)
                        ->get();

        // Get data Reviewer
        $reviewer = [];
        $dataReviewer = Reviewer::join('users', 'reviewer.user_id', '=', 'users.id')
            ->join('role', 'role.role_id', '=', 'reviewer.role_id')
            ->where('user_id', $user_id)
            ->get();
        if (!$dataReviewer->isEmpty()) {
            $reviewer[0] = $dataReviewer[0]->nip;
            $reviewer[1] = $dataReviewer[0]->role_id;
        }
    
        // Get detail data of pengajuan beasiswa
        $dataPengajuan = PengajuanBeasiswa::join('beasiswa', 'pengajuan_beasiswa.beasiswa_id', '=', 'beasiswa.id')
        ->join('mahasiswa', 'pengajuan_beasiswa.nim', '=', 'mahasiswa.nim')
        ->join('users','mahasiswa.user_id', '=', 'users.id')
        ->join('kode_status', 'kode_status.id_status', '=', 'pengajuan_beasiswa.status')
        ->select('beasiswa.*', 'users.name', 'pengajuan_beasiswa.id','pengajuan_beasiswa.status', 'pengajuan_beasiswa.tanggal_pengajuan', 'kode_status.isi_status')
        ->where('pengajuan_beasiswa.id', $id)
        ->get();
        
        $dataStatus = KodeStatus::get();
    
        return view('pages.Pengajuan.tracking-pengajuan', compact('dataPengajuan', 'userData', 'dataStatus', 'reviewer'));
    }

    public function progressPengajuan(Request $request, string $id) {
        $validatedData = $request->validate([
            'reviewerComment' => 'nullable',
            'role_id' => 'required|integer'
        ]);

        $role_id = $validatedData['role_id'];
    
        $dataPengajuan = PengajuanBeasiswa::find($id);
        if (!$dataPengajuan) {
            return redirect()->route('pengajuan.tracking', ['id' => $id])
                             ->with('error', 'Data Pengajuan not found.');
        }
    
        // Set data komentar
        $dataPengajuan->komentar = $validatedData['reviewerComment'] ?? null;

        if ($role_id == 1) {
            $reviseStatus = 3;
        } elseif ($role_id == 2) {
            $reviseStatus = 7;
        } elseif ($role_id == 3) {
            $reviseStatus = 9;
        } elseif ($role_id >= 4) {
            $reviseStatus = 5;
        }
    
        // Update status based button input
        switch ($request->input('action')) {
            case 'reject':
                $dataPengajuan->status = 11;
                break;
            case 'revise':
                $dataPengajuan->status = $reviseStatus;
                break;
            case 'approve':
                $dataPengajuan->status = 10;
                break;
            default:
                return redirect()->route('pengajuan.tracking', ['id' => $id])
                                 ->with('error', 'Invalid action.');
        }
    
        $dataPengajuan->save();
    
        return redirect()->route('pengajuan.tracking', ['id' => $id])
                         ->with('success', 'Status updated successfully.');
    }    
}
