<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;
use App\Models\SyaratBeasiswa;
use App\Models\SyaratDokumen;
use App\Models\BenefitBeasiswa;
use App\Models\JenjangPendidikan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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

    public function getListBeasiswaForStaff()
    {

        return view('pages.Beasiswa.list-beasiswa-staff');

    }

    public function getPengumumanBeasiswa()
    {

        return view('pages.Beasiswa.pengumuman-beasiswa');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $beasiswa = null;
        $syarat = null;
        return view('pages.Beasiswa.form-beasiswa', compact('beasiswa', 'syarat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'nama_beasiswa.required' => 'Nama beasiswa wajib diisi.',
            'nama_beasiswa.string' => 'Nama beasiswa harus berupa teks.',
            'nama_beasiswa.max' => 'Nama beasiswa tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Deskripsi beasiswa tidak boleh kosong.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'jenis_beasiswa.required' => 'Jenis beasiswa harus diisi.',
            'tipe_beasiswa.required' => 'Tipe beasiswa harus diisi.',
            'kuota_beasiswa.required' => 'Kuota beasiswa harus diisi.',
            'kuota_beasiswa.integer' => 'Kuota beasiswa harus berupa angka.',
            'kuota_beasiswa.min' => 'Kuota beasiswa minimal adalah 1.',
            'sumber_beasiswa.required' => 'Sumber beasiswa wajib diisi.',
            'sumber_beasiswa.string' => 'Sumber beasiswa harus berupa teks.',
            'sumber_beasiswa.max' => 'Sumber beasiswa tidak boleh lebih dari 255 karakter.',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_mulai.before' => 'Tanggal mulai harus sebelum tanggal berakhir.',
            'tanggal_berakhir.required' => 'Tanggal berakhir harus diisi.',
            'tanggal_berakhir.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
            'tanggal_berakhir.after' => 'Tanggal berakhir harus setelah tanggal mulai.',
            'ipk_min.numeric' => 'IPK minimal harus berupa angka.',
            'ipk_min.min' => 'IPK minimal tidak boleh kurang dari 0.',
            'ipk_min.max' => 'IPK minimal tidak boleh lebih dari 4.',
        ];
        
        // Validasi input
        $validatedData = $request->validate([
            'nama_beasiswa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis_beasiswa' => 'required|string|in:full,setengah',
            'tipe_beasiswa' => 'required|string|in:prestasi,ekonomi,external',
            'kuota_beasiswa' => 'required|integer|min:1',
            'sumber_beasiswa' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date|before:tanggal_berakhir',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'ipk_min' => 'numeric|max:4|min:1',
            'syarat_beasiswa' => 'array',
            'syarat_beasiswa.*' => 'string',
            'benefit_beasiswa' => 'array',
            'benefit_beasiswa.*' => 'string|max:255', 
            'jenjang_pendidikan' => 'array',
            'jenjang_pendidikan.*' => 'string|max:100', 
        ], $messages);
    
        // menambahkan ipk_min ke array syarat
        if (isset($validatedData['ipk_min'])) {
            // Anda bisa menambahkan ipk_min ke dalam syarat_beasiswa
            $validatedData['syarat_beasiswa'][] = $validatedData['ipk_min'];
        }
        
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
        
        // Handle file uploads
        $fileKeys = ['file_1', 'file_2', 'file_3'];
        $fileUrls = []; // Initialize an empty array to store file URLs

        foreach ($fileKeys as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $newRequest = new Request();
                $newRequest->files->set('file', $file);
                $newRequest->merge(['path' => 'poster']);

                // Call the uploadFile method from FileController
                $fileController = new FileController();
                $uploadedFileUrl = $fileController->uploadFile($newRequest);

                // Store the uploaded file URL in the array
                $fileUrls[] = $uploadedFileUrl->getData()->url ?? null;
            } else {
                $fileUrls[] = null;
            }
        }

        // Assign URLs from $fileUrls array
        $linkPoster1 = $fileUrls[0] ?? null;

        
        // Simpan data beasiswa ke database dan dapatkan objek Beasiswa
        $beasiswa = Beasiswa::create([
            'nama_beasiswa' => $validatedData['nama_beasiswa'],
            'deskripsi' => $validatedData['deskripsi'],
            'jenis_waktu_beasiswa' => $jenis_waktu,
            'jenis_beasiswa' => $validatedData['jenis_beasiswa'],
            'tipe_beasiswa' => $validatedData['tipe_beasiswa'],
            'kuota' => $validatedData['kuota_beasiswa'],
            'sumber' => $validatedData['sumber_beasiswa'],
            'tanggal_mulai' => $validatedData['tanggal_mulai'],
            'tanggal_berakhir' => $validatedData['tanggal_berakhir']
        ]); 
            
        // Log the created scholarship data
        Log::info('Beasiswa created successfully: ', [$beasiswa]);

        // Simpan syarat-syarat beasiswa, jika ada
        if (isset($validatedData['syarat_beasiswa'])) {
            foreach ($validatedData['syarat_beasiswa'] as $syarat) {
                SyaratBeasiswa::create([
                    'beasiswa_id' => $beasiswa->id,
                    'syarat' => $syarat
                ]);
            }
        }
    
        // Simpan benefit beasiswa, jika ada
        if (isset($validatedData['benefit_beasiswa'])) {
            foreach ($validatedData['benefit_beasiswa'] as $benefit) {
                BenefitBeasiswa::create([
                    'beasiswa_id' => $beasiswa->id,
                    'benefit' => $benefit,
                    'deskripsi_benefit' => $benefit
                ]);
            }
        }
    
        $syarat_dokumen = [
            "Esai", 
            "Surat Keterangan Penghasilan Orangtua", 
            "Transkrip Nilai", 
            "Surat Keterangan Tidak Mampu", 
            "Proposal", 
            "Sertifikat Prestasi", 
            "Surat Rekomendasi"
        ];
    
        if (isset($validatedData['syarat_beasiswa'])) {
            foreach ($validatedData['syarat_beasiswa'] as $syarat){
                foreach ($syarat_dokumen as $dokumen){
                    if ($syarat == $dokumen) {
                        SyaratDokumen::create([
                            'beasiswa_id' => $beasiswa->id,
                            'dokumen' => $dokumen,
                            'deskripsi_dokumen' => $dokumen
                        ]);
                    }
                } 
            }
        }
    
        // Simpan jenjang pendidikan, jika ada
        if (isset($validatedData['jenjang_pendidikan'])) {
            foreach ($validatedData['jenjang_pendidikan'] as $jenjang){
                JenjangPendidikan::create([
                    'beasiswa_id' => $beasiswa->id,
                    'jenjang' => $jenjang
                ]);
            }
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
        // Ambil data dari database berdasarkan ID
        $beasiswa = Beasiswa::with(['syaratBeasiswa', 'jenjangPendidikan', 'benefitBeasiswa', 'syaratDokumen'])->find($id);
        $syarat = $beasiswa->syaratBeasiswa->pluck('syarat')->toArray();
        $jenjang = $beasiswa->jenjangPendidikan->pluck('jenjang')->toArray();
        $benefit = $beasiswa->benefitBeasiswa->pluck('benefit')->toArray();
        $dokumen = $beasiswa->syaratDokumen->pluck('dokumen')->toArray();

        // Kirim data ke view
        return view('pages.Beasiswa.form-beasiswa', compact('beasiswa', 'syarat', 'jenjang', 'dokumen', 'benefit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi
        $messages = [
            'nama_beasiswa.required' => 'Nama beasiswa wajib diisi.',
            'nama_beasiswa.string' => 'Nama beasiswa harus berupa teks.',
            'nama_beasiswa.max' => 'Nama beasiswa tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Deskripsi beasiswa tidak boleh kosong.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'jenis_beasiswa.required' => 'Jenis beasiswa harus diisi.',
            'tipe_beasiswa.required' => 'Tipe beasiswa harus diisi.',
            'kuota_beasiswa.required' => 'Kuota beasiswa harus diisi.',
            'kuota_beasiswa.integer' => 'Kuota beasiswa harus berupa angka.',
            'kuota_beasiswa.min' => 'Kuota beasiswa minimal adalah 1.',
            'sumber_beasiswa.required' => 'Sumber beasiswa wajib diisi.',
            'sumber_beasiswa.string' => 'Sumber beasiswa harus berupa teks.',
            'sumber_beasiswa.max' => 'Sumber beasiswa tidak boleh lebih dari 255 karakter.',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_mulai.before' => 'Tanggal mulai harus sebelum tanggal berakhir.',
            'tanggal_berakhir.required' => 'Tanggal berakhir harus diisi.',
            'tanggal_berakhir.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
            'tanggal_berakhir.after' => 'Tanggal berakhir harus setelah tanggal mulai.',
            'ipk_min.numeric' => 'IPK minimal harus berupa angka.',
            'ipk_min.min' => 'IPK minimal tidak boleh kurang dari 0.',
            'ipk_min.max' => 'IPK minimal tidak boleh lebih dari 4.',
        ];
        
        // Validasi input
        $validatedData = $request->validate([
            'nama_beasiswa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis_beasiswa' => 'required|string|in:full,setengah',
            'tipe_beasiswa' => 'required|string|in:prestasi,ekonomi,external',
            'kuota_beasiswa' => 'required|integer|min:1',
            'sumber_beasiswa' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date|before:tanggal_berakhir',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'ipk_min' => 'numeric|max:4|min:1',
            'syarat_beasiswa' => 'array',
            'syarat_beasiswa.*' => 'string',
            'benefit_beasiswa' => 'array',
            'benefit_beasiswa.*' => 'string|max:255', 
            'jenjang_pendidikan' => 'array',
            'jenjang_pendidikan.*' => 'string|max:100', 
        ], $messages);


        // menambahkan ipk_min ke array syarat
        if (isset($validatedData['ipk_min'])) {
            // Anda bisa menambahkan ipk_min ke dalam syarat_beasiswa
            $validatedData['syarat_beasiswa'][] = $validatedData['ipk_min'];
        }
        // jenis_waktu_beasiswa
        $tgl_mulai = strtotime($validatedData['tanggal_mulai']);
        $tgl_akhir = strtotime($validatedData['tanggal_berakhir']);
        $tgl_skrg = time();

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
    
        $beasiswa = Beasiswa::findOrFail($id);
        $beasiswa->fill([
            'nama_beasiswa' => $validatedData['nama_beasiswa'],
            'deskripsi' => $validatedData['deskripsi'],
            'jenis_beasiswa' => $validatedData['jenis_beasiswa'],
            'tipe_beasiswa' => $validatedData['tipe_beasiswa'],
            'kuota' => $validatedData['kuota_beasiswa'],
            'tanggal_mulai' => $validatedData['tanggal_mulai'],
            'tanggal_berakhir' => $validatedData['tanggal_berakhir'],
            'jenis_waktu_beasiswa' => $jenis_waktu,
            'sumber' => $validatedData['sumber_beasiswa'],
        ]);
        $beasiswa->save();

        SyaratDokumen::where('beasiswa_id', $id)->delete();

        SyaratBeasiswa::where('beasiswa_id', $id)->delete();

        foreach ($validatedData['syarat_beasiswa'] as $syarat_beasiswa) {
            SyaratBeasiswa::create([
                'beasiswa_id' => $beasiswa->id,
                'syarat' => $syarat_beasiswa
            ]);
            SyaratDokumen::create([
                'beasiswa_id' => $beasiswa->id,
                'dokumen' => $syarat_beasiswa,
                'deskripsi_dokumen' => $syarat_beasiswa
            ]);
        }

        BenefitBeasiswa::where('beasiswa_id', $id)->delete();
        foreach ($validatedData['benefit_beasiswa'] as $benefit_beasiswa) {
            BenefitBeasiswa::create([
                'beasiswa_id' => $beasiswa->id,
                'benefit' => $benefit_beasiswa,
                'deskripsi_benefit' => $benefit_beasiswa
            ]);
        }

        JenjangPendidikan::where('beasiswa_id', $id)->delete();
        foreach ($request->input('jenjang_pendidikan') as $jenjang_pendidikan) {
            JenjangPendidikan::create([
                'beasiswa_id' => $beasiswa->id,
                'jenjang' => $jenjang_pendidikan
            ]);
        }

        return redirect()->route('beasiswa.index')->with('success', 'Data beasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // Find the item by ID
        $item = Beasiswa::findOrFail($id);

        // Delete the item
        $item->delete();

        // Redirect back with a success message
        return redirect()->route('beasiswa.index')->with('success', 'Item deleted successfully!');

    }
}
