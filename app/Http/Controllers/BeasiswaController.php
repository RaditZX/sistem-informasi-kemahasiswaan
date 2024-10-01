<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
<<<<<<< Updated upstream
use Illuminate\Http\Request;
=======
use App\Models\SyaratBeasiswa;
use App\Models\SyaratDokumen;
use App\Models\BenefitBeasiswa;
use App\Models\JenjangPendidikan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

>>>>>>> Stashed changes

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< Updated upstream
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
=======
        $user = Auth::user();
        $name = $user->name; 
        $email = $user->email;
        $role_id = $user->role_id;
        $beasiswa = beasiswa::All();

        return view('pages.Beasiswa.list-beasiswa', compact('email', 'name', 'role_id', 'beasiswa'));
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
