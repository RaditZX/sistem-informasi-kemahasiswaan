<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\PenerimaBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MaddingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get newest beasiswa based on tanggal_mulai
        $newestBeasiswa = Beasiswa::orderBy('tanggal_mulai', 'desc')
                                    ->take(7) // Limit to 7 items
                                    ->get();  // Fetch the collection

        // Add short_description to each item
        $newestBeasiswa->transform(function ($item) {
        $item->short_description = Str::limit($item->deskripsi, 100, '...');
        return $item;
        });

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

        return view('pages.Madding.madding', compact('newestBeasiswa', 'newestMahasiswaAccepted'));
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
