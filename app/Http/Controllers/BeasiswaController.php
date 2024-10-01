<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;
use App\Models\SyaratBeasiswa;
use App\Models\SyaratDokumen;
use App\Models\BenefitBeasiswa;
use App\Models\JenjangPendidikan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beasiswa = Beasiswa::all();
        $user = Auth::user();
        $name = $user->name; 
        $email = $user->email;
        $role_id = $user->role_id;
        $beasiswa = beasiswa::All();

        return view('pages.Beasiswa.list-beasiswa', compact('email', 'name', 'role_id', 'beasiswa'));


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
        // jenis_waktu_beasiswa
        $tgl_mulai = strtotime($request->tanggal_mulai);
        $tgl_akhir = strtotime($request->tanggal_berakhir);
        $tgl_skrg = date( time());

        // current = tgl_mulai <= tgl_skrg <= tgl_akhir
        // upcoming = tgl_skrg < tgl_mulai
        // last = tgl_skrg > tgl_akhir
        if ($tgl_skrg < $tgl_mulai){
            $jenis_waktu = 'upcoming';
        } elseif ($tgl_mulai <= $tgl_skrg && $tgl_skrg <= $tgl_akhir){
            $jenis_waktu = 'current';
        } else {
            $jenis_waktu = 'last';
        }
        
        
        // Simpan data beasiswa ke database dan dapatkan objek Beasiswa
        $beasiswa_id = Beasiswa::create([
            'nama_beasiswa' => $request->nama_beasiswa,
            'deskripsi' => $request->deskripsi,
            'jenis_waktu_beasiswa' => $jenis_waktu,
            'jenis_beasiswa' => $request->jenis_beasiswa,
            'tipe_beasiswa' => $request->tipe_beasiswa,
            'kuota' => $request->kuota_beasiswa,
            'sumber' => $request->sumber_beasiswa,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir
        ])->id;
    
        // // Cek jika penyimpanan beasiswa berhasil
        // if (!$beasiswa) {
        //     return redirect('/form-beasiswa')->with('error', 'Gagal menyimpan data beasiswa.');
        // }
    
        // Ambil ID dari objek Beasiswa
        

        // Simpan syarat-syarat beasiswa, jika ada
        $syarat_beasiswa = $request->input('syarat_beasiswa');
        if ($syarat_beasiswa) {
            foreach ($syarat_beasiswa as $syarat) {
                SyaratBeasiswa::create([
                    'beasiswa_id' => $beasiswa_id,
                    'syarat' => $syarat
                ]);
            }
        }

        $benefit_beasiswa = $request->input('benefit_beasiswa');
        if ($benefit_beasiswa) {
            foreach ($benefit_beasiswa as $benefit) {
                BenefitBeasiswa::create([
                    'beasiswa_id' => $beasiswa_id,
                    'benefit' => $benefit,
                    'deskripsi_benefit' => $benefit
                ]);
            }
        }

        $syarat_dokumen = array("Esai", "Surat Keterangan Penghasilan Orangtua", "Transkrip Nilai", "Surat Keterangan Tidak Mampu", "Proposal", "Sertifikat Prestasi", "Surat Rekomendasi");
        foreach ($syarat_beasiswa as $syarat){
            foreach($syarat_dokumen as $dokumen){
                if ($syarat == $dokumen) {
                    SyaratDokumen::create([
                        'beasiswa_id' => $beasiswa_id,
                        'dokumen' => $dokumen,
                        'deskripsi_dokumen' => $dokumen
                    ]);
                }
            } 
        }
        
        $jenjang_pendidikan = $request->input('jenjang_pendidikan');
        foreach ($jenjang_pendidikan as $jenjang){
            JenjangPendidikan::create([
                'beasiswa_id' => $beasiswa_id,
                'jenjang' => $jenjang
            ]);
        }
    
        return redirect('/form-beasiswa')->with('success', 'Beasiswa berhasil ditambahkan');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $beasiswa = Beasiswa::findOrFail($id); 
        return view('pages.Beasiswa.detail-beasiswa', ['beasiswa' => $beasiswa, 'id' => $id]);
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
