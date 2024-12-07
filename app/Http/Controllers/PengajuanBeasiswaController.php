<?php

namespace App\Http\Controllers;

use App\Models\PengajuanDokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanBeasiswa;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NotificationController;
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
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        return view('pages.Pengajuan.tracking-pengajuan', compact('email', 'name', 'role_id', 'notificationData'));
    }


    public function listPengajuanStaff()
    {
        $user_id = Auth::id();

        // Get notification data
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        // Check if the user is a reviewer and get their NIP
        $dataReviewer = Reviewer::where('user_id', $user_id)
            ->join('users', 'reviewer.user_id', '=', 'users.id')
            ->join('role', 'reviewer.role_id', '=', 'role.id')
            ->select('reviewer.nip', 'reviewer.role_id', 'role.role_name')
            ->first();

        if ($dataReviewer) {
            $reviewerNIP = $dataReviewer->nip;
            $reviewerID = $dataReviewer->role_id;
            $reviewerRole = $dataReviewer->role_name;
        }

        // Build the Pengajuan query
        $query = PengajuanBeasiswa::join('beasiswa', 'pengajuan_beasiswa.beasiswa_id', '=', 'beasiswa.id')
            ->join('mahasiswa', 'pengajuan_beasiswa.nim', '=', 'mahasiswa.nim')
            ->join('users', 'mahasiswa.user_id', '=', 'users.id')
            ->join('kode_status', 'kode_status.id', '=', 'pengajuan_beasiswa.status')
            ->select(
                'beasiswa.*',
                'users.nama_depan',
                'users.nama_belakang',
                'pengajuan_beasiswa.id',
                'pengajuan_beasiswa.status',
                'pengajuan_beasiswa.tanggal_pengajuan'
            );

        // If the user is not a reviewer, restrict results to their own submissions
        if ($reviewerNIP === null) {
            $query->where('users.id', $user_id);
        } else {
            if ($reviewerID === 1) {
                $query->where('pengajuan_beasiswa.status', '<=', 3);
            } elseif ($reviewerID === 2) {
                $query->whereBetween('pengajuan_beasiswa.status', [4, 5]);
            } elseif ($reviewerID === 3) {
                $query->whereBetween('pengajuan_beasiswa.status', [6, 7]);
            } elseif ($reviewerID === 4) {
                $query->whereBetween('pengajuan_beasiswa.status', [8, 9]);
            }
        }

        $listPengajuan = $query->get();

        // Return the view with data
        return view('pages.Beasiswa.list-pengaju-beasiswa', compact('listPengajuan', 'notificationData'));
    }

    public function create(string $id)
    {
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();
        return view('pages.Beasiswa.pengajuan', compact('notificationData'));
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
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData(); 

        return view('pages.PengajuanBeasiswa.formPengajuan', compact('notificationData'), ['pengajuan' => $pengajuan_beasiswa, 'dokumen_pengajauan' => $dokumenPengajuan ]);
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
            return redirect()->route('pengajuan.create',['id'=>$id])->with('failed', 'No documents found for pengajuan id: ' . $id);
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

        return redirect()->route('pengajuan.create',['id'=>$id])->with('success', 'Documents updated successfully.');
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

    public function showTracking(string $id)
    {
        // Get authenticated user ID
        $user_id = Auth::id();

        // Check if the user is a Mahasiswa
        $userData = User::join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            ->select('users.email', 'mahasiswa.nim')
            ->where('users.id', $user_id)
            ->first(); // Use `first()` instead of `get()` to retrieve a single record.

        // Check if the user is a Reviewer
        $dataReviewer = Reviewer::join('users', 'reviewer.user_id', '=', 'users.id')
            ->join('role', 'role.id', '=', 'reviewer.role_id')
            ->select('reviewer.nip', 'reviewer.role_id')
            ->where('users.id', $user_id) // Correct the column name to `users.id` for clarity.
            ->first();

        $reviewerNIP = $dataReviewer->nip ?? null; // Use null coalescing to handle potential null values.
        $reviewerID = $dataReviewer->role_id ?? null;

        // Debugging purpose (can be removed in production)
        // dd($reviewerID);

        // Get detail data of pengajuan beasiswa
        $dataPengajuan = PengajuanBeasiswa::join('beasiswa', 'pengajuan_beasiswa.beasiswa_id', '=', 'beasiswa.id')
            ->join('mahasiswa', 'pengajuan_beasiswa.nim', '=', 'mahasiswa.nim')
            ->join('users', 'mahasiswa.user_id', '=', 'users.id')
            ->join('kode_status', 'kode_status.id', '=', 'pengajuan_beasiswa.status')
            ->select(
                'beasiswa.*',
                'users.nama_depan',
                'pengajuan_beasiswa.id',
                'pengajuan_beasiswa.status',
                'pengajuan_beasiswa.tanggal_pengajuan',
                'kode_status.isi_status'
            )
            ->where('pengajuan_beasiswa.id', $id)
            ->first(); // Use `first()` to fetch a single record.

        // Fetch all status codes
        $dataStatus = KodeStatus::all();

        return view('pages.Pengajuan.tracking-pengajuan', compact('dataPengajuan', 'userData', 'dataStatus', 'dataReviewer'));
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
            $approveStatus = 4;
        } elseif ($role_id == 2) {
            $reviseStatus = 5;
            $approveStatus = 6;
        } elseif ($role_id == 3) {
            $reviseStatus = 7;
            $approveStatus = 8;
        } elseif ($role_id == 4) {
            $reviseStatus = 9;
            $approveStatus = 10;
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
                $dataPengajuan->status = $approveStatus;
                break;
            default:
                return redirect()->route('pengajuan.tracking', ['id' => $id])
                                 ->with('error', 'Invalid action.');
        }
    
        $dataPengajuan->save();
    
        return redirect()->route('pengajuan.tracking', ['id' => $id])
                         ->with('success', 'Status updated successfully.');
    }

    public function batalkanPengajuan(string $id) {
        PengajuanBeasiswa::where('id', $id)->delete();

        return redirect()->route('pengajuan.list-pengajuan')->with('msg', 'Pengajuan mu telah di batalkan');
    }
}
