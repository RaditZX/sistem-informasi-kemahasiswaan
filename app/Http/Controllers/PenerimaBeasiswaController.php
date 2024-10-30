<?php

namespace App\Http\Controllers;

use App\Models\PenerimaBeasiswa;
use Illuminate\Http\Request;

class PenerimaBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penerima_beasiswa = PenerimaBeasiswa::All();

        return view('pages.Beasiswa.pengumuman-beasiswa', compact('penerima_beasiswa'));
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
    public function show(PenerimaBeasiswa $penerimaBeasiswa)
    {
        //
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
