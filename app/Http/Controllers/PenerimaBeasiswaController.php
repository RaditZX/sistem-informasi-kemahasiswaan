<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BeasiswaController;
use App\Models\Beasiswa;
use App\Models\Jurusan;
use App\Models\PenerimaBeasiswa;
use App\Models\PengajuanBeasiswa;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class PenerimaBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $beasiswaController = new BeasiswaController();
        $query = $beasiswaController->buildBeasiswaQuery($request);

        // Jalankan query dan paginasi hasilnya
        $beasiswa = $query->join('poster_beasiswa as pb', 'pb.beasiswa_id', '=', 'beasiswa.id')
            ->paginate(8);

        // Data pengguna untuk view
        $jurusan = Jurusan::all();

        // Kirim data ke view
        return view('pages.Beasiswa.list-pengumumanBeasiswa', compact('beasiswa', 'jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.Beasiswa.import-data-beasiswa');
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
            DB::transaction(function () use ($file) {
                (new FastExcel)->import($file, function ($line) {
                    // Validate each row of data
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
                        // Handle external or KIPK type beasiswa
                        if (!in_array($beasiswa->tipe_beasiswa, ['eksternal', 'kipk'])) {
                            $checkPengajuan = PengajuanBeasiswa::where('nim', $data['nim'])
                                ->where('beasiswa_id', $beasiswaID)
                                ->exists();

                            if ($checkPengajuan) {
                                PenerimaBeasiswa::create([
                                    'nim' => $data['nim'],
                                    'beasiswa_id' => $beasiswaID,
                                ]);
                            }
                        } else {
                            PenerimaBeasiswa::create([
                                'nim' => $data['nim'],
                                'beasiswa_id' => $beasiswaID,
                            ]);
                        }
                    } else {
                        // Handle half-type beasiswa
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
            });

            return redirect()->route('beasiswa.import-data-beasiswa')
                ->with('success', 'Beasiswa data imported successfully.');
        } catch (\Throwable $e) {
            Log::error('Beasiswa Import Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return redirect()->route('beasiswa.import-data-beasiswa')
                ->with('error', 'Failed to import beasiswa data.');
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
        $user = Auth::user();
        $reviewer = Reviewer::where('user_id', $user->id)->first();
        $beasiswa = Beasiswa::findOrFail($id);

        return view('pages.Beasiswa.pengumuman-beasiswa', compact('penerima_beasiswa', 'beasiswa','reviewer'));
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
                'Tanggal Diterima' => $item->created_at->format('Y-m-d')
            ];
        });


        $beasiswaName = $penerima_beasiswa->first()->nama_beasiswa ?? 'default_beasiswa';
        $fileName = 'penerima_beasiswa_' . $beasiswaName . now()->format('Ymd_His') . '.xlsx';

        // Export data using FastExcel
        return (new FastExcel($list))->download($fileName);
    }
}
