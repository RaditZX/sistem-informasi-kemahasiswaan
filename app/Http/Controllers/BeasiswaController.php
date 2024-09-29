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
        // Fetch all records from the 'beasiswa' table
<<<<<<< Updated upstream
        $beasiswas = Beasiswa::all();

        // Pass the data to the view
        return view('pages.Beasiswa.list-beasiswa', ['beasiswas' => $beasiswas]);
=======
        $beasiswa = Beasiswa::all();

        // Pass the data to the view
        return view('pages.Beasiswa.list-beasiswa', ['beasiswas' => $beasiswa]);
>>>>>>> Stashed changes
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
        $beasiswa = Beasiswa::findOrFail($id); 
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
