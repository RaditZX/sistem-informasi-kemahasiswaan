<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.Beasiswa.list-beasiswa');
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
        Beasiswa::create([
            'nama_beasiswa' => $request->nama_beasiswa,
            'deskripsi' => $request->deskripsi,
            'jenis_beasiswa' => $request->jenis_beasiswa,
            'kuota' => $request->kuota_beasiswa,
            'sumber' => $request->sumber_beasiswa,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir
        ]);

        return redirect('/form-beasiswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $beasiswa = Beasiswa::findOrFail($id); // Mengambil data beasiswa berdasarkan ID
        return view('pages.Beasiswa.detail-beasiswa', compact('beasiswa'));
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
