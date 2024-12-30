<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\SyaratBeasiswa;
use App\Models\SyaratDokumen;
use App\Models\BenefitBeasiswa;
use App\Models\JenjangPendidikan;
use App\Models\PosterBeasiswa;
use App\Models\Prodi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class BeasiswaController extends Controller
{

    public function getBeasiswaDataBaseOnBeasiswaId(int $id){
        $beasiswa = Beasiswa::findOrFail($id);
        return $beasiswa;
    }

    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
        $user_id = $user->id;
    
        // Prepare the query for Beasiswa
        $query = Beasiswa::query();
    
        // Filter search by 'nama_beasiswa'
        if ($request->has('search') && $request->input('search') !== '') {
            $searchTerm = $request->input('search');
            $query->where('nama_beasiswa', 'ilike', "%{$searchTerm}%");
        }
    
        // Filter by 'jenis_beasiswa'
        if ($request->has('jenis_beasiswa') && !empty($request->input('jenis_beasiswa'))) {
            $jenisBeasiswa = $request->input('jenis_beasiswa');
            foreach ($jenisBeasiswa as $jenis) {
                $query->orWhere('jenis_beasiswa', $jenis);
            }
        }
    
        // Filter by 'tipe_beasiswa' (full or half)
        if ($request->has('tipe_beasiswa') && !empty($request->input('tipe_beasiswa'))) {
            $tipeBeasiswa = $request->input('tipe_beasiswa');
            $query->where('tipe_beasiswa', $tipeBeasiswa); // Filter by full or half
        }
    
        // Filter by 'jurusan' in 'syarat_beasiswa'
        if ($request->has('jurusan') && !empty($request->input('jurusan'))) {
            $jurusan = $request->input('jurusan');
            $query->whereHas('syaratBeasiswa', function ($q) use ($jurusan) {
                $q->where('syarat', 'like', "%{$jurusan}%");
            });
        }
    
        // Retrieve beasiswa data, join with 'poster_beasiswa', and paginate
        $beasiswa = $query->join('poster_beasiswa as pb', 'pb.beasiswa_id', '=', 'beasiswa.id')
                          ->paginate(8);
    
        // Ambil data mahasiswa dan beasiswa yang diterima
        $mahasiswa = Mahasiswa::where('user_id', $user_id)->first();
        $penerimaBeasiswa = $mahasiswa ? $mahasiswa->penerimaBeasiswa()->with('beasiswa')->get() : [];
    
        // Olah data untuk menentukan tipe beasiswa yang diterima
        $beasiswaUserTipe = [];
        foreach ($penerimaBeasiswa as $item) {
        $jenis = $item->beasiswa->jenis_beasiswa; // Ambil tipe beasiswa (full atau half)
        $createdAt = $item->created_at; // Tanggal pengumuman

        if ($jenis === 'full') {
            $status = 'Closed Permanently';
        } elseif ($jenis === 'half' && $createdAt->addYear() > now()) {
            $status = 'Closed';
        } else {
            $status = 'Open Again';
        }

        $beasiswaUserTipe[] = [
            'id' => $item->beasiswa->id,
            'jenis' => $jenis,
            'status' => $status,
        ];
    }
    
        // Return the view with data
        return view('pages.Beasiswa.list-beasiswa', compact(
            'beasiswa', 
            'penerimaBeasiswa', 
            'beasiswaUserTipe'
        ));
    }
    public function getListBeasiswaForStaff(Request $request)
    {
        $query = Beasiswa::query();

        // Filter `search` berdasarkan `nama_beasiswa`
        if ($request->has('search') && $request->input('search') !== '') {
            $searchTerm = $request->input('search');
            $query->where('nama_beasiswa', 'ilike', "%{$searchTerm}%");
        }

        // Filter `jenis_beasiswa`
        if ($request->has('jenis_beasiswa') && !empty($request->input('jenis_beasiswa'))) {
            $jenisBeasiswa = $request->input('jenis_beasiswa');
            foreach ($jenisBeasiswa as $jenis) {
                $query->orWhere('jenis_beasiswa', $jenis);
            }
        }

        // Filter `tipe_beasiswa`
        if ($request->has('tipe_beasiswa') && !empty($request->input('tipe_beasiswa'))) {
            $query->where('tipe_beasiswa', $request->input('tipe_beasiswa'));
        }

        // Filter `jurusan` dalam `syarat_beasiswa`
        if ($request->has('jurusan') && !empty($request->input('jurusan'))) {
            $jurusan = $request->input('jurusan');
            $query->whereHas('syaratBeasiswa', function ($q) use ($jurusan) {
                $q->where('syarat', 'like', "%{$jurusan}%");
            });
        }

        // Jalankan query dan paginasi hasilnya
        $beasiswa = $query->join('poster_beasiswa as pb', 'pb.beasiswa_id', '=', 'beasiswa.id')
                  ->paginate(10);


        return view('pages.Beasiswa.list-beasiswa-staff',compact('beasiswa'));

    }

    public function getDetailBeasiswaKipk($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('pages.Beasiswa.detail-beasiswa-kipk', compact('beasiswa'));
    }

    public function getDetailBeasiswaEksternal($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('pages.Beasiswa.detail-beasiswa-eksternal', compact('beasiswa'));
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
        // dd($request);

        // Validasi input
        $validatedData = $request->validate($this->validation_rules, $this->validation_messages);

         // Modifikasi tanggal_berakhir
        $tanggal_berakhir = Carbon::parse($request->tanggal_berakhir)->subDays(5);

        // Validasi tambahan untuk memastikan tanggal_mulai sesuai dengan tanggal_berakhir yang telah dimodifikasi
        if ($tanggal_berakhir->lte(Carbon::parse($request->tanggal_mulai))) {
            return back()->withErrors(['tanggal_mulai' => 'Tanggal mulai harus sebelum tanggal berakhir - 5 hari.'])->withInput();
        }

        // Handle file upload
        $fileUrls = []; 

        if ($request->hasFile('poster')){
            foreach ($request->file('poster') as $file) {
                    $newRequest = new Request();
                    $newRequest->files->set('file', $file);
                    $newRequest->merge(['path' => 'poster']);

                    // Call the uploadFile method from FileController
                    $fileController = new FileController();
                    $uploadedFileUrl = $fileController->uploadFileLocal($newRequest);

                    // Store the uploaded file URL in the array
                    $fileUrls[] = $uploadedFileUrl->getData()->url ?? null;
            }
        }

        $lastId = DB::table('beasiswa')->max('id');
        // Simpan data beasiswa ke database dan dapatkan objek Beasiswa
        $beasiswa = Beasiswa::create([
            'id'=> $lastId ? $lastId + 1 : 1,
            'nama_beasiswa' => $validatedData['nama_beasiswa'],
            'deskripsi' => $validatedData['deskripsi'],
            'jenis_beasiswa' => $validatedData['jenis_beasiswa'],
            'tipe_beasiswa' => $validatedData['tipe_beasiswa'],
            'kuota' => $validatedData['kuota_beasiswa'],
            'sumber' => $validatedData['sumber_beasiswa'],
            'tanggal_mulai' => $validatedData['tanggal_mulai'],
            'tanggal_berakhir' => $validatedData['tanggal_berakhir']
        ]);

        $existingposters = $request->input('poster');
        if (isset($existingposters)) {
            foreach ($existingposters as $poster) {
                if (filter_var($poster, FILTER_VALIDATE_URL)) {
                    $fileUrls[] = $poster;
                }
            }
        }

        // dd($request, $existingposters, $request->file('poster'), $fileUrls);

        // Simpan poster beasiswa
        foreach ($fileUrls as $url){
            PosterBeasiswa::create([
                'beasiswa_id' => $beasiswa->id,
                'link_poster' => $url
            ]);
        }

        // Simpan syarat-syarat beasiswa, jika ada
        if (isset($validatedData['syarat_beasiswa'])) {
            foreach ($validatedData['syarat_beasiswa'] as $syarat) {
                // Cari syarat dalam tabel syarat_beasiswa
                $existingSyarat = SyaratBeasiswa::where('syarat', $syarat)->first();

                // Jika syarat tidak ditemukan, tambahkan ke tabel syarat_beasiswa
                if (!$existingSyarat) {
                    $existingSyarat = SyaratBeasiswa::create(['syarat' => $syarat]);
                }

                // Hubungkan beasiswa dengan syarat (tabel pivot)
                $beasiswa->syaratBeasiswa()->attach($existingSyarat->id);
            }
        }
        


        // Simpan benefit beasiswa, jika ada
        if (isset($validatedData['benefit_beasiswa'])) {
            foreach ($validatedData['benefit_beasiswa'] as $benefit) {
                $existingBenefit = BenefitBeasiswa::where('benefit', $benefit)->first();

                if(!$existingBenefit){
                    $existingBenefit = BenefitBeasiswa::create(['benefit' => $benefit]);
                }

                $beasiswa->benefitBeasiswa()->attach($existingBenefit->id);
            }
        }
        
        if ($request->hasFile('dokumen_file')){
            foreach ($request->file('dokumen_file') as $file) {
                    $newRequest = new Request();
                    $newRequest->files->set('file', $file);
                    $newRequest->merge(['path' => 'dokumen']);

                    // Call the uploadFile method from FileController
                    $fileController = new FileController();
                    $uploadedFileUrl = $fileController->uploadFileLocal($newRequest);

                    // Store the uploaded file URL in the array
                    $dokumenUrls[] = $uploadedFileUrl->getData()->url ?? null;
            }
        }

        // dd($validatedData['nama_dokumen'], $dokumenUrls);
        if (isset($validatedData['nama_dokumen'])) {
            $index = 0;
            foreach ($validatedData['nama_dokumen'] as $dokumen) {
                $existingDokumen = SyaratDokumen::where('dokumen', $dokumen)->first();


                if(!$existingDokumen){
                    $existingDokumen = SyaratDokumen::create([
                        'dokumen' => $dokumen, 
                        'link_dokumen' => $dokumenUrls[$index],
                    ]);
                    $index++;
                }

                $beasiswa->syaratDokumen()->attach($existingDokumen->id);
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

        // Log the created scholarship data
        Log::info('Beasiswa created successfully: ', [$beasiswa]);

        return redirect('/list-beasiswa-staff')->with('success', 'Beasiswa berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $beasiswa = Beasiswa::with(['syaratBeasiswa', 'jenjangPendidikan', 'benefitBeasiswa', 'syaratDokumen', 'posterBeasiswa'])
        ->findOrFail($id);

        $syarat = $beasiswa->syaratBeasiswa->pluck('syarat')->toArray();
        $jenjang = $beasiswa->jenjangPendidikan->pluck('jenjang')->toArray();
        $benefit = $beasiswa->benefitBeasiswa->pluck('benefit')->toArray();
        $dokumen = $beasiswa->syaratDokumen->pluck('dokumen')->toArray();
        $poster = $beasiswa->posterBeasiswa->pluck('link_poster')->toArray();



        return view('pages.Beasiswa.detail-beasiswa', [
            'beasiswa' => $beasiswa,
            'id' => $id,
            'syarat' => $syarat,
            'jenjang' => $jenjang,
            'benefit' => $benefit,
            'dokumen' => $dokumen,
            'poster' => $poster
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data dari database berdasarkan ID
        $beasiswa = Beasiswa::with(['syaratBeasiswa', 'jenjangPendidikan', 'benefitBeasiswa', 'syaratDokumen', 'posterBeasiswa'])->find($id);
        $syarat = $beasiswa->syaratBeasiswa->pluck('syarat')->toArray();
        $jenjang = $beasiswa->jenjangPendidikan->pluck('jenjang')->toArray();
        $benefit = $beasiswa->benefitBeasiswa->pluck('benefit')->toArray();
        $dokumen = $beasiswa->syaratDokumen->pluck('dokumen')->toArray();
        $link_dokumen = $beasiswa->syaratDokumen->pluck('link_dokumen')->toArray();


        $poster = $beasiswa->posterBeasiswa->pluck('link_poster')->toArray();
        
        // dd($dokumen, $link_dokumen);
        // Kirim data ke view
        return view('pages.Beasiswa.form-beasiswa', compact('beasiswa', 'syarat', 'jenjang', 'dokumen', 'link_dokumen', 'benefit', 'poster'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        // validasi
        $validatedData = $request->validate($this->validation_rules, $this->validation_messages);
        
        // Modifikasi tanggal_berakhir
        $tanggal_berakhir = Carbon::parse($request->tanggal_berakhir)->subDays(5);

        // Validasi tambahan untuk memastikan tanggal_mulai sesuai dengan tanggal_berakhir yang telah dimodifikasi
        if ($tanggal_berakhir->lte(Carbon::parse($request->tanggal_mulai))) {
            return back()->withErrors(['tanggal_mulai' => 'Tanggal mulai harus sebelum tanggal berakhir - 5 hari.'])->withInput();
        }

        try {
            $beasiswa = Beasiswa::findOrFail($id);
            $beasiswa->fill([
                'nama_beasiswa' => $validatedData['nama_beasiswa'],
                'deskripsi' => $validatedData['deskripsi'],
                'jenis_beasiswa' => $validatedData['jenis_beasiswa'],
                'tipe_beasiswa' => $validatedData['tipe_beasiswa'],
                'kuota' => $validatedData['kuota_beasiswa'],
                'tanggal_mulai' => $validatedData['tanggal_mulai'],
                'tanggal_berakhir' => $validatedData['tanggal_berakhir'],
                'sumber' => $validatedData['sumber_beasiswa'],
            ]);
            $beasiswa->save();

            $fileUrls = [];  // Array untuk menyimpan URL file

            // dd($request->poster);
            // Memeriksa jika ada file yang diupload
            if ($request->hasFile('input_poster')) {
                foreach ($request->file('input_poster') as $file) {
                    $newRequest = new Request();
                    $newRequest->files->set('file', $file);
                    $newRequest->merge(['path' => 'poster']);

                    // Call the uploadFile method from FileController
                    $fileController = new FileController();
                    $uploadedFileUrl = $fileController->uploadFileLocal($newRequest);


                    // Store the uploaded file URL in the array
                    $fileUrls[] = $uploadedFileUrl->getData()->url ?? null;
                    // dd($fileUrls);
                }
            }
            // dd($fileUrls);

            if (isset($request->poster)) {
                foreach ($request->poster as $poster) {
                    if (filter_var($poster, FILTER_VALIDATE_URL)) {
                        // dd($poster);
                        $fileUrls[] = $poster; 
                    }
                }
                

                // Menghapus poster yang ada jika ada perubahan
                $existingPoster = PosterBeasiswa::where('beasiswa_id', $id)->get();
                if (!($fileUrls == $existingPoster)) {
                    $beasiswa->posterBeasiswa()->delete();
                }

            }
            foreach ($fileUrls as $poster) {
                // Memastikan hanya link yang valid dimasukkan
                if (filter_var($poster, FILTER_VALIDATE_URL)) {
                    $beasiswa->posterBeasiswa()->create([
                        'link_poster' => $poster,
                    ]);
                } else {
                    // Anda bisa log atau memberikan notifikasi jika ada link yang tidak valid
                    Log::warning("Invalid URL skipped: $poster");
                }
            }

            // Simpan atau update syarat-syarat beasiswa, jika ada
            if (isset($validatedData['syarat_beasiswa'])) {
                $beasiswa->syaratBeasiswa()->detach();
                foreach ($validatedData['syarat_beasiswa'] as $syarat) {
                    // Cari syarat dalam tabel syarat_beasiswa
                    $existingSyarat = SyaratBeasiswa::where('syarat', $syarat)->first();

                    // Jika syarat tidak ditemukan, tambahkan ke tabel syarat_beasiswa
                    if (!$existingSyarat) {
                        $existingSyarat = SyaratBeasiswa::create(['syarat' => $syarat]);
                    }

                    // Hubungkan beasiswa dengan syarat (tabel pivot)
                    $beasiswa->syaratBeasiswa()->syncWithoutDetaching([$existingSyarat->id]);
                }
            } else {
                $beasiswa->syaratBeasiswa()->detach();
            }

            // Simpan atau update benefit beasiswa, jika ada
            if (isset($validatedData['benefit_beasiswa'])) {
                $beasiswa->benefitBeasiswa()->detach();
                foreach ($validatedData['benefit_beasiswa'] as $benefit) {
                    $existingBenefit = BenefitBeasiswa::where('benefit', $benefit)->first();

                    // Jika benefit tidak ditemukan, tambahkan ke tabel benefit_beasiswa
                    if(!$existingBenefit) {
                        $existingBenefit = BenefitBeasiswa::create(['benefit' => $benefit]);
                    }

                    // Hubungkan beasiswa dengan benefit (tabel pivot)
                    $beasiswa->benefitBeasiswa()->syncWithoutDetaching([$existingBenefit->id]);
                }
            } else {
                $beasiswa->benefitBeasiswa()->detach();
            }

            // Simpan atau update syarat dokumen, jika ada
            if ($request->hasFile('dokumen_file')){
                foreach ($request->file('dokumen_file') as $file) {
                        $newRequest = new Request();
                        $newRequest->files->set('file', $file);
                        $newRequest->merge(['path' => 'dokumen']);
    
                        // Call the uploadFile method from FileController
                        $fileController = new FileController();
                        $uploadedFileUrl = $fileController->uploadFileLocal($newRequest);
    
                        // Store the uploaded file URL in the array
                        $dokumenUrls[] = $uploadedFileUrl->getData()->url ?? null;
                }
            }

            $beasiswa->syaratDokumen()->detach();
            if (isset($validatedData['nama_dokumen'])) {
                $index = 0;
                foreach ($validatedData['nama_dokumen'] as $dokumen) {
                    $existingDokumen = SyaratDokumen::where('dokumen', $dokumen)->first();
    
    
                    if(!$existingDokumen){
                        $existingDokumen = SyaratDokumen::create([
                            'dokumen' => $dokumen, 
                            'link_dokumen' => $dokumenUrls[$index],
                        ]);
                        $index++;
                    }
    
                    $beasiswa->syaratDokumen()->attach($existingDokumen->id);
                }
            }

            

            // Simpan atau update jenjang pendidikan, jika ada
            if (isset($validatedData['jenjang_pendidikan'])) {
                $beasiswa->jenjangPendidikan()->delete();
                foreach ($validatedData['jenjang_pendidikan'] as $jenjang) {
                    // Pastikan jenjang tidak sudah ada dalam beasiswa
                    $existingJenjang = JenjangPendidikan::where('beasiswa_id', $beasiswa->id)
                                                        ->where('jenjang', $jenjang)
                                                        ->first();
                    if (!$existingJenjang) {
                        JenjangPendidikan::create([
                            'beasiswa_id' => $beasiswa->id,
                            'jenjang' => $jenjang
                        ]);
                    }
                }
            } else {
                $beasiswa->jenjangPendidikan()->delete();
            }


            // Log the updated scholarship data
            Log::info('Beasiswa updated successfully: ', [$beasiswa]);
            // dd($beasiswa->syaratBeasiswa, $beasiswa->benefitBeasiswa, $beasiswa->syaratDokumen, $beasiswa->jenjangPendidikan, $beasiswa->posterBeasiswa, $beasiswa);

            return redirect()->route('beasiswa.list-beasiswa-staff')->with('success', 'Data beasiswa berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating scholarship: ', ['error' => $e->getMessage()]);


            // return redirect()->back()->withErrors(['msg' => 'Terjadi kesalahan saat memperbarui data beasiswa.']);
                // ->withInput($request->all())
                // ->withErrors(['msg' => 'Terjadi kesalahan saat memperbarui data beasiswa.']);
        }
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
        return redirect()->route('beasiswa.list-beasiswa-staff')->with('success', 'Item deleted successfully!');

    }

    public function search_syarat(Request $request)
    {
        $search = $request->input('query');
        $tags = SyaratBeasiswa::where('syarat', 'LIKE', "%{$search}%")->distinct()->limit(10)->get(['syarat']);

        return response()->json($tags);
    }
    public function search_dokumen(Request $request)
    {
        $search = $request->input('query');
        $tags = SyaratDokumen::where('dokumen', 'LIKE', "%{$search}%")->distinct()->limit(10)->get(['dokumen', 'link_dokumen']);

        return response()->json($tags);
    }
    public function search_benefit(Request $request)
    {
        $search = $request->input('query');
        $tags = BenefitBeasiswa::where('benefit', 'LIKE', "%{$search}%")->distinct()->limit(10)->get(['benefit']);

        return response()->json($tags);
    }

    public function search_jenjang(Request $request)
    {
        $search = $request->input('query');
        $tags = Prodi::where('nama_prodi', 'LIKE', "%{$search}%")->distinct()->limit(10)->get(['nama_prodi']);
        $tags->prepend(['nama_prodi' => 'Semua Jenjang']);

        return response()->json($tags);
    }

    public function getBeasiswaTemplate(Request $request)
    {
        $templates = beasiswa::select('id', 'nama_beasiswa', 'deskripsi')
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
    
        // Perpendek deskripsi
        $templates->getCollection()->transform(function ($item) {
            $item->deskripsi = Str::limit($item->deskripsi, 100, '...');
            return $item;
        });
    
        return response()->json([
            'data' => $templates->items(),
            'current_page' => $templates->currentPage(),
            'last_page' => $templates->lastPage(),
        ]);
    }
    


    public function getBeasiswa($id)
    {
        // Ambil data dari database berdasarkan ID
        $beasiswa = Beasiswa::with([
            'syaratBeasiswa', 
            'jenjangPendidikan', 
            'benefitBeasiswa', 
            'syaratDokumen', 
            'posterBeasiswa'
        ])->find($id); // Just use find($id) without 'id' and without get()
        
        // Cek apakah data beasiswa ditemukan
        if (!$beasiswa) {
            return response()->json(['message' => 'Beasiswa not found'], 404);
        }

        // Ambil data dari relasi dan pluck kolom yang dibutuhkan
        $syarat = $beasiswa->syaratBeasiswa->pluck('syarat')->toArray();
        $jenjang = $beasiswa->jenjangPendidikan->pluck('jenjang')->toArray();
        $benefit = $beasiswa->benefitBeasiswa->pluck('benefit')->toArray();
        $dokumen = $beasiswa->syaratDokumen->pluck('dokumen')->toArray();
        $link_dokumen = $beasiswa->syaratDokumen->pluck('link_dokumen')->toArray();
        $poster = $beasiswa->posterBeasiswa->pluck('link_poster')->toArray();

        // dd($beasiswa, $syarat, $jenjang, $benefit, $dokumen, $link_dokumen, $poster);
        // Return data dalam format JSON
        return response()->json([
            'beasiswa' => $beasiswa,
            'syarat' => $syarat,
            'jenjang' => $jenjang,
            'benefit' => $benefit,
            'dokumen' => $dokumen,
            'link_dokumen' => $link_dokumen,
            'poster' => $poster
        ]);
    }


    private $validation_messages = [
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
        'poster.required' => 'Poster Beasiswa wajib ada.',
        'poster.max' => 'Poster Beasiswa tidak boleh lebih dari 3.'
    ];

    private $validation_rules = [
        'nama_beasiswa' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'jenis_beasiswa' => 'required|string|in:full,half',
        'tipe_beasiswa' => 'required|string|in:kipk,internal,eksternal',
        'kuota_beasiswa' => 'required|integer|min:1',
        'sumber_beasiswa' => 'required|string|max:255',
        'tanggal_mulai' => 'required|date|before:tanggal_berakhir',
        'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
        'syarat_beasiswa' => 'array',
        'syarat_beasiswa.*' => 'string|nullable',
        'nama_dokumen' => 'array',
        'nama_dokumen.*' => 'string',
        'benefit_beasiswa' => 'array',
        'benefit_beasiswa.*' => 'string|max:255|nullable',
        'jenjang_pendidikan' => 'array',
        'jenjang_pendidikan.*' => 'string|max:100|nullable',
        // 'poster' => 'required|array|max:3',
        // 'poster.*' => 'required|string|url:http|mimes:jpeg,png,jpg',

    ];
}
