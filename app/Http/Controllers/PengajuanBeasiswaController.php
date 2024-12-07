<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PengajuanDokumenController;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\beasiswa;
use App\Models\KodeStatus;
use App\Models\PengajuanBeasiswa;
use App\Models\PengajuanDokumen;
use App\Models\Prodi;
use App\Models\Reviewer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $name = $user->name;
        // $email = $user->email;
        // $role_id = $user->role_id;
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        return view('pages.Pengajuan.tracking-pengajuan', compact('notificationData'));
    }


    public function listPengajuanStaff()
    {

        // Get notification data
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        $user = Auth::user();
        $mhs = Mahasiswa::where('user_id',$user->id)->first();

        if($mhs){
            $listPengajuan = PengajuanBeasiswa::join('beasiswa', 'pengajuan_beasiswa.beasiswa_id', '=', 'beasiswa.id')
            ->join('mahasiswa', 'pengajuan_beasiswa.nim', '=', 'mahasiswa.nim')
            ->join('users', 'mahasiswa.user_id', '=', 'users.id')
            ->join('kode_status', 'kode_status.id','=','pengajuan_beasiswa.status')
            ->select('beasiswa.*', 'users.nama_depan', 'pengajuan_beasiswa.status', 'pengajuan_beasiswa.tanggal_pengajuan','kode_status.isi_status')->where('mahasiswa.nim','=',$mhs->nim)
            ->get();
        }else{

            $listPengajuan = PengajuanBeasiswa::join('beasiswa', 'pengajuan_beasiswa.beasiswa_id', '=', 'beasiswa.id')
            ->join('mahasiswa', 'pengajuan_beasiswa.nim', '=', 'mahasiswa.nim')
            ->join('users', 'mahasiswa.user_id', '=', 'users.id')
            ->select('beasiswa.*', 'users.nama_depan', 'pengajuan_beasiswa.status', 'pengajuan_beasiswa.tanggal_pengajuan')
            ->get();
        }

        $namaBeasiswa = Beasiswa::pluck('nama_beasiswa');

        return view('pages.Beasiswa.list-pengaju-beasiswa', compact('listPengajuan','notificationData', 'namaBeasiswa'));
    }

    public function create(string $id)
    {
        $user = Auth::user();
        $mhs = Mahasiswa::where('user_id','=',$user->id)->first();
        $prodi = Prodi::where('id',$mhs->prodi_id)->first();
        $jurusan = Jurusan::where('id', $prodi->jurusan_id)->first();

        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();
        $pengajuan = null;
        $dokumenPengajuan = null;
        return view('pages.Beasiswa.pengajuan-beasiswa', compact('notificationData','user','pengajuan','dokumenPengajuan','mhs', 'jurusan','prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {


        // Validate the incoming request data
         $request->validate([
            'file_1' => 'required|file',
            'file_2' => 'required|file',
            'file_3' => 'required|file',
            'file_4' => 'required|file',
            'file_5' => 'required|file',
        ]);

        $user = Auth::user();
        $mhs = Mahasiswa::where('user_id','=',$user->id)->first();

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create the PengajuanBeasiswa record
            $pengajuanBeasiswa = PengajuanBeasiswa::create([
                'nim' =>  $mhs->nim,
                'beasiswa_id' => $id,
                'tanggal_pengajuan' => now(),
                'status'=> 1
            ]);



            $fileKeys = ['file_1', 'file_2', 'file_3', 'file_4', 'file_5'];

            foreach ($fileKeys as $fileKey) {
                $file = $request->file($fileKey);

                // Extract file name
                $fileName = $file->getClientOriginalName();

                $newRequest = new Request();
                $newRequest->files->set('file', $file);
                $newRequest->merge(['path' => 'dokumen']);

                // Upload the file
                $fileController = new FileController();
                $fileUrl = $fileController->uploadFile($newRequest);

                // Create PengajuanDokumen record
                PengajuanDokumen::create([
                    'kode_dokumen' => hash('sha256', $fileName.rand(0,99999)),
                    'nama_dokumen' => $fileName,
                    'link_dokumen' => $fileUrl->getData()->url,
                    'id_pengajuan_beasiswa' => $pengajuanBeasiswa->id,
                ]);
            }

            DB::commit();

            $email = new MailController();
            $request = new Request($email->mahasiswaPengajuanMessage($mhs->nim,$id));
            $email->sendMail($request, false);
            $request = new Request($email->reviewerPengajuanMessage($mhs->nim,$id));
            $email->sendMail($request, true);

            return redirect()->route('pengajuan.create', ['id' => $id])->with('success', 'Beasiswa created successfully.');

        } catch (\Exception $e) {
            // Rollback the transaction if any error occurs
            DB::rollBack();

            // Optionally log the exception for debugging purposes
            Log::error("Error creating Pengajuan Beasiswa: {$e->getMessage()}", ['exception' => $e]);

            return redirect()->route('pengajuan.create', ['id' => $id])->with('failed', 'Failed to create Beasiswa . Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengajuan_beasiswa = PengajuanBeasiswa::findOrFail($id);
        $query = PengajuanDokumen::query();
        $query->where('id_pengajuan_beasiswa', $id);
        $dokumenPengajuan = $query->get();

        $user = Auth::user();
        $mhs = Mahasiswa::where('user_id','=',$user->id)->first();
        $prodi = Prodi::where('id',$mhs->prodi_id)->first();
        $jurusan = Jurusan::where('id', $prodi->jurusan_id)->first();

        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();
        return view('pages.Beasiswa.pengajuan-beasiswa', ['pengajuan' => $pengajuan_beasiswa, 'dokumen_pengajauan' => $dokumenPengajuan, 'notificationData'=>$notificationData, 'prodi'=>$prodi,'jurusan'=>$jurusan, 'user'=>$user, 'mhs'=>$mhs]);
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
            $dokumenPengajuan = PengajuanDokumen::where('id_pengajuan_beasiswa', '=', $id)
                ->orderBy('created_at', 'asc')
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
                    $dokumen->link_dokumen = $fileUrl->getData()->url;
                    $dokumen->save();
                }
            }

            DB::commit();
            return redirect()->route('pengajuan.show', ['id' => $id])->with('success', 'Documents updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Log::error("Error updating documents for Pengajuan ID: {$id}", ['exception' => $e]);
            return redirect()->route('pengajuan.show', ['id' => $id])->with('failed', 'Failed to update documents. Please try again later.');
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
