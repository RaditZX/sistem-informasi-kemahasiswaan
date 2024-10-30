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

    public function getImportDataBeasiswa()
    {
        return view('pages.Beasiswa.import-data-beasiswa');
    }

    public function getDetailBeasiswaKipk()
    {
        return view('pages.Beasiswa.detail-beasiswa-kipk');
    }

    public function getDetailBeasiswaEksternal()
    {
        return view('pages.Beasiswa.detail-beasiswa-eksternal');
    }

    public function getListPengajuBeasiswa()
    {
        return view('pages.Beasiswa.list-pengaju-beasiswa');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'nama_beasiswa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis_beasiswa' => 'required|string|max:255',
            'tipe_beasiswa' => 'required|string|max:255',
            'kuota_beasiswa' => 'required|integer',
            'sumber_beasiswa' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'file_1' => 'required|file',
            'syarat_beasiswa' => 'nullable|array',
            'benefit_beasiswa' => 'nullable|array',
            'jenjang_pendidikan' => 'nullable|array',
        ]);


        // Determine the scholarship time type
        $tgl_mulai = strtotime($validatedData['tanggal_mulai']);
        $tgl_akhir = strtotime($validatedData['tanggal_berakhir']);
        $tgl_skrg = time(); // current timestamp



        if ($tgl_skrg < $tgl_mulai) {
            $jenis_waktu = 'upcoming';
        } elseif ($tgl_mulai <= $tgl_skrg && $tgl_skrg <= $tgl_akhir) {
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

        // Ensure linkPoster1 is not null since it's required by the database
        if ($linkPoster1 === null) {
            return back()->withErrors(['file_1' => 'File 1 is required and must be uploaded successfully.']);
        }

        try {
            // Save the scholarship data into the database
            $beasiswa = Beasiswa::create([
                'nama_beasiswa' => $validatedData['nama_beasiswa'],
                'deskripsi' => $validatedData['deskripsi'],
                'jenis_waktu_beasiswa' => $jenis_waktu,
                'jenis_beasiswa' => $validatedData['jenis_beasiswa'],
                'tipe_beasiswa' => $validatedData['tipe_beasiswa'],
                'kuota' => $validatedData['kuota_beasiswa'],
                'sumber' => $validatedData['sumber_beasiswa'],
                'tanggal_mulai' => $validatedData['tanggal_mulai'],
                'tanggal_berakhir' => $validatedData['tanggal_berakhir'],
                'link_poster_1' => $linkPoster1,
            ]);

            // Log the created scholarship data
            Log::info('Beasiswa created successfully: ', [$beasiswa]);

            // Save scholarship requirements, if any
            $syarat_beasiswa = $request->input('syarat_beasiswa', []);
            foreach ($syarat_beasiswa as $syarat) {
                SyaratBeasiswa::create([
                    'beasiswa_id' => $beasiswa->id,
                    'syarat' => $syarat,
                ]);
            }

            // Save scholarship benefits, if any
            $benefit_beasiswa = $request->input('benefit_beasiswa', []);
            foreach ($benefit_beasiswa as $benefit) {
                BenefitBeasiswa::create([
                    'beasiswa_id' => $beasiswa->id,
                    'benefit' => $benefit,
                    'deskripsi_benefit' => $benefit,
                ]);
            }

            // Define required documents
            $syarat_dokumen = [
                "Esai", "Surat Keterangan Penghasilan Orangtua",
                "Transkrip Nilai", "Surat Keterangan Tidak Mampu",
                "Proposal", "Sertifikat Prestasi", "Surat Rekomendasi"
            ];

            foreach ($syarat_beasiswa as $syarat) {
                foreach ($syarat_dokumen as $dokumen) {
                    if ($syarat == $dokumen) {
                        SyaratDokumen::create([
                            'beasiswa_id' => $beasiswa->id,
                            'dokumen' => $dokumen,
                            'deskripsi_dokumen' => $dokumen,
                        ]);
                    }
                }
            }

            // Save education levels, if any
            $jenjang_pendidikan = $request->input('jenjang_pendidikan', []);
            foreach ($jenjang_pendidikan as $jenjang) {
                JenjangPendidikan::create([
                    'beasiswa_id' => $beasiswa->id,
                    'jenjang' => $jenjang,
                ]);
            }

            return redirect('/form-beasiswa')->with('success', 'Beasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            // Log any errors that occur during database transactions
            Log::error('Error creating Beasiswa: ', [$e->getMessage()]);
            return back()->withErrors(['error' => 'An error occurred while creating the scholarship.']);
        }
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

        // Find the item by ID
        $item = Beasiswa::findOrFail($id);

        // Delete the item
        $item->delete();

        // Redirect back with a success message
        return redirect()->route('beasiswa.index')->with('success', 'Item deleted successfully!');

    }
}
