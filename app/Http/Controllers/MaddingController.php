<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\PenerimaBeasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaddingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get today's date
        $today = Carbon::today();

        // Get newest beasiswa based on tanggal_mulai
        $newestBeasiswa = Beasiswa::leftJoin('jenjang_pendidikan', 'jenjang_pendidikan.beasiswa_id', '=', 'beasiswa.id')
                                    ->select(
                                        'beasiswa.id',
                                        'beasiswa.nama_beasiswa',
                                        'beasiswa.deskripsi',
                                        'beasiswa.tipe_beasiswa',
                                        'beasiswa.jenis_beasiswa',
                                        'beasiswa.kuota',
                                        'beasiswa.sumber',
                                        'beasiswa.tanggal_mulai',
                                        'beasiswa.tanggal_berakhir',
                                        DB::raw("COALESCE(array_agg(jenjang_pendidikan.jenjang) FILTER (WHERE jenjang_pendidikan.jenjang IS NOT NULL), ARRAY['All Jenjang Pendidikan']) AS jenjang_list")
                                    )
                                    ->where('beasiswa.tanggal_mulai', '<=', $today)
                                    ->where('beasiswa.tanggal_berakhir', '>=', $today)
                                    ->groupBy('beasiswa.id', 'beasiswa.nama_beasiswa', 'beasiswa.tanggal_mulai')
                                    ->orderBy('beasiswa.tanggal_mulai', 'desc')
                                    ->take(7)
                                    ->get();

        // Add short_description to each item
        $newestBeasiswa->transform(function ($item) {
        $item->short_description = Str::limit($item->deskripsi, 100, '...');
        return $item;
        });

        // Process the jenjang_list string into an array
        foreach ($newestBeasiswa as $beasiswa) {
        // Remove the curly braces and quotes, then split by commas
        $jenjangListArray = explode(',', trim($beasiswa->jenjang_list, '{}'));

        // Clean up the extra spaces or quotes from each item
        $jenjangListArray = array_map(function ($item) {
            return trim($item, '"'); // Remove any extra quotes
        }, $jenjangListArray);

        // Attach the cleaned-up array back to the beasiswa object
        $beasiswa->jenjang_list = $jenjangListArray;
        }

        // Get upcoming beasiswa where tanggal_mulai is greater than today
        $upcomingBeasiswa = Beasiswa::leftJoin('jenjang_pendidikan', 'jenjang_pendidikan.beasiswa_id', '=', 'beasiswa.id')
            ->select(
                'beasiswa.id',
                'beasiswa.nama_beasiswa',
                'beasiswa.deskripsi',
                'beasiswa.tipe_beasiswa',
                'beasiswa.jenis_beasiswa',
                'beasiswa.kuota',
                'beasiswa.sumber',
                'beasiswa.tanggal_mulai',
                'beasiswa.tanggal_berakhir',
                DB::raw("COALESCE(array_agg(jenjang_pendidikan.jenjang) FILTER (WHERE jenjang_pendidikan.jenjang IS NOT NULL), ARRAY['All Jenjang Pendidikan']) AS jenjang_list")
            )
            ->where('beasiswa.tanggal_mulai', '>', $today) // Filter for dates greater than today
            ->groupBy('beasiswa.id', 'beasiswa.nama_beasiswa', 'beasiswa.tanggal_mulai')
            ->orderBy('beasiswa.tanggal_mulai', 'desc')
            ->take(7)
            ->get();

        // Add short_description to each item
        $upcomingBeasiswa->transform(function ($item) {
            $item->short_description = Str::limit($item->deskripsi, 100, '...');
            return $item;
        });

        // Process the jenjang_list string into an array
        foreach ($upcomingBeasiswa as $beasiswa) {
            // Remove the curly braces and quotes, then split by commas
            $jenjangListArray = explode(',', trim($beasiswa->jenjang_list, '{}'));

            // Clean up the extra spaces or quotes from each item
            $jenjangListArray = array_map(function ($item) {
                return trim($item, '"'); // Remove any extra quotes
            }, $jenjangListArray);

            // Attach the cleaned-up array back to the beasiswa object
            $beasiswa->jenjang_list = $jenjangListArray;
        }

        // Get newest mahasiswa who receive beasiswa
        $newestMahasiswaAccepted = PenerimaBeasiswa::join('beasiswa', 'beasiswa.id', '=', 'penerima_beasiswa.beasiswa_id')
                                                     ->join('mahasiswa', 'mahasiswa.nim', '=', 'penerima_beasiswa.nim')
                                                     ->join('users', 'mahasiswa.user_id', '=', 'users.id')
                                                     ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id')
                                                     ->join('jurusan', 'prodi.jurusan_id', '=', 'jurusan.id')
                                                     ->select(
                                                        'users.nama_depan',
                                                        'users.nama_belakang',
                                                        'mahasiswa.angkatan',
                                                        'beasiswa.nama_beasiswa',
                                                        'beasiswa.tanggal_mulai',
                                                        'beasiswa.tanggal_berakhir',
                                                        'prodi.*',
                                                        'penerima_beasiswa.*'
                                                     )
                                                     ->whereMonth('penerima_beasiswa.created_at', now()->month)
                                                     ->whereYear('penerima_beasiswa.created_at', now()->year)
                                                     ->orderBy('penerima_beasiswa.created_at', 'desc')
                                                     ->take(12)
                                                     ->paginate(4);

        return view('pages.Madding.madding', compact('newestBeasiswa', 'upcomingBeasiswa', 'newestMahasiswaAccepted'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
