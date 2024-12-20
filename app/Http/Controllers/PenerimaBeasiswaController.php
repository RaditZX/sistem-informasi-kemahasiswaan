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
        return view('pages.Beasiswa.list-pengumumanBeasiswa', compact('beasiswa', 'notificationData'));
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

                $beasiswa = Beasiswa::where('nama_beasiswa', $data['beasiswa'])->first();

                if (!$beasiswa) {
                    throw new \Exception("Beasiswa with name {$data['beasiswa']} not found.");
                }

                $beasiswaID = $beasiswa->id;

                $penerimaBeasiswa = PenerimaBeasiswa::where('nim', $data['nim'])->first();

                if (!$penerimaBeasiswa) {
                    PenerimaBeasiswa::create([
                        'nim' => $data['nim'],
                        'beasiswa_id' => $beasiswaID,
                    ]);
                } else {
                    if ($beasiswa->jenis_beasiswa === 'half') {
                        $oneYearAgo = now()->subYear();
                        if ($penerimaBeasiswa->created_at <= $oneYearAgo) {
                            PenerimaBeasiswa::create([
                                'nim' => $data['nim'],
                                'beasiswa_id' => $beasiswaID,
                            ]);
                        }
                    }
                }
            });


            return redirect()->route('beasiswa.import-data-beasiswa',)->with('success', 'Beasiswa created successfully.');
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


        $beasiswa = Beasiswa::findOrFail($id);
        return view('pages.Beasiswa.pengumuman-beasiswa', compact('penerima_beasiswa', 'notificationData', 'beasiswa'));
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

    public function exportPenerimaBeasiswaInExcel(string $id)
    {
        // Fetch the scholarship recipients with related data
        $penerima_beasiswa = PenerimaBeasiswa::join('mahasiswa', 'penerima_beasiswa.nim', '=', 'mahasiswa.nim')
            ->join('users', 'mahasiswa.user_id', '=', 'users.id')
            ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id')
            ->join('jurusan', 'prodi.jurusan_id', '=', 'jurusan.id')
            ->join('beasiswa', 'penerima_beasiswa.beasiswa_id', '=', 'beasiswa.id')
            ->where('beasiswa_id', '=', $id)
            ->select(
                'penerima_beasiswa.nim',
                'users.nama_depan',
                'users.nama_belakang',
                'jurusan.nama_jurusan',
                'prodi.nama_prodi',
                'beasiswa.nama_beasiswa',
                'penerima_beasiswa.created_at' // Fixed typo
            )
            ->get();

        // Check if there's data to export
        if ($penerima_beasiswa->isEmpty()) {
            return back()->with('error', 'No data found to export.');
        }

        // Map data to a suitable format for FastExcel
        $list = $penerima_beasiswa->map(function ($item) {
            return [
                'NIM' => $item->nim,
                'Nama' => $item->nama_depan . ' ' . $item->nama_belakang,
                'Jurusan' => $item->nama_jurusan,
                'Prodi' => $item->nama_prodi,
                'Beasiswa' => $item->nama_beasiswa,
                'Tanggal Diterima' => $item->created_at->format('Y-m-d'), // Optional: Format date for readability
            ];
        });


        $beasiswaName = $penerima_beasiswa->first()->nama_beasiswa ?? 'default_beasiswa';
        $fileName = 'penerima_beasiswa_' . $beasiswaName . now()->format('Ymd_His') . '.xlsx';

        // Export data using FastExcel
        return (new FastExcel($list))->download($fileName);
    }
}
