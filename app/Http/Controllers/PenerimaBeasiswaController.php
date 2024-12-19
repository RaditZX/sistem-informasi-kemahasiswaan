<?php

namespace App\Http\Controllers;

use App\Http\Controllers\NotificationController;
use App\Models\beasiswa;
use App\Models\PenerimaBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Auth;

class PenerimaBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Beasiswa::query();

        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        // Filter `search` berdasarkan `nama_beasiswa`
        if ($request->has('search') && $request->input('search') !== '') {
            $searchTerm = $request->input('search');
            $query->where('nama_beasiswa', 'ilike', "%{$searchTerm}%");
        }

        // Filter `jenis_beasiswa`
        if ($request->has('jenis_beasiswa') && !empty($request->input('jenis_beasiswa'))) {
            $jenisBeasiswa = $request->input('jenis_beasiswa');
            foreach ($jenisBeasiswa as $jenis) {
                $query->orWhere('jenis_beasiswa', $jenis);
            }
        }

        // Filter `tipe_beasiswa`
        if ($request->has('tipe_beasiswa') && !empty($request->input('tipe_beasiswa'))) {
            $query->where('tipe_beasiswa', $request->input('tipe_beasiswa'));
        }

        // Filter `jurusan` dalam `syarat_beasiswa`
        if ($request->has('jurusan') && !empty($request->input('jurusan'))) {
            $jurusan = $request->input('jurusan');
            $query->whereHas('syaratBeasiswa', function ($q) use ($jurusan) {
                $q->where('syarat', 'like', "%{$jurusan}%");
            });
        }

        // Jalankan query dan paginasi hasilnya
        $beasiswa = $query->join('poster_beasiswa as pb', 'pb.beasiswa_id', '=', 'beasiswa.id')
        ->paginate(8);

        // Data pengguna untuk view
        $user = Auth::user();



        // Kirim data ke view
        return view('pages.Beasiswa.list-pengumumanBeasiswa', compact('beasiswa','notificationData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();
        return view('pages.Beasiswa.import-data-beasiswa', compact('notificationData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi file input
        $validator = Validator::make($request->all(), [
            'excelFile' => 'required|file|mimes:xlsx,csv,xls|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $file = $request->file('excelFile');
            $penerima = (new FastExcel)->import($file, function ($line) {
                // Validasi setiap baris data
                $data = Validator::make($line, [
                    'nim' => 'required|integer',
                    'beasiswa' => 'required|string|exists:beasiswa,nama_beasiswa',
                ])->validate();

                // Ambil beasiswa_id berdasarkan nama_beasiswa
                $beasiswaID = Beasiswa::where('nama_beasiswa', '=', $data['beasiswa'])->value('id');

                if (!$beasiswaID) {
                    throw new \Exception("Beasiswa with name {$data['beasiswa']} not found.");
                }

                PenerimaBeasiswa::create([
                    'nim' => $data['nim'],
                    'beasiswa_id' => $beasiswaID,
                ]);
            });


            return redirect()->route('beasiswa.import-data-beasiswa', )->with('success', 'Beasiswa created successfully.');
        } catch (\Throwable $e) {
            // Tangani error
            return redirect()->route('beasiswa.import-data-beasiswa',)->with('success', 'Beasiswa created successfully.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penerima_beasiswa = PenerimaBeasiswa::join('mahasiswa', 'penerima_beasiswa.nim', '=', 'mahasiswa.nim')
        ->join('users', 'mahasiswa.user_id', '=', 'users.id')
        ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id')
        ->join('jurusan', 'prodi.jurusan_id', '=', 'jurusan.id')
        ->where('beasiswa_id', '=', $id)
        ->get();
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        $pdf = new FileController();
        $pdfUrl = $pdf->getPdfUrlFromDatabaseUrl("https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/dokumen%2Fpraktikum+Design+pattern.pdf?alt=media
");

        $beasiswa = Beasiswa::findOrFail($id);
        return view('pages.Beasiswa.pengumuman-beasiswa', compact('penerima_beasiswa', 'notificationData', 'beasiswa','pdfUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenerimaBeasiswa $penerimaBeasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenerimaBeasiswa $penerimaBeasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenerimaBeasiswa $penerimaBeasiswa)
    {
        //
    }
}