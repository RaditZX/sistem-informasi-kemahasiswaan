<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Reviewer;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Ambil data user yang sedang login

        // Data umum
        $user_id = $user->id;
        $user_img = $user->foto;
        $email = $user->email;
        $phone = $user->phone;
        $jk = $user->jenis_kelamin;

        // Nama pengguna
        $nama_depan = $user->nama_depan;
        $nama_belakang = $user->nama_belakang;

        // Default data untuk NIM, NIP, dan no_hp
        $nim = null;
        $nip = null;
        $no_hp = $phone;

        // Cek apakah user adalah mahasiswa
        if ($user->mahasiswa) {
            $nim = $user->mahasiswa->nim;
            $no_hp = $user->mahasiswa->no_hp ?: $phone; // Gunakan no_hp mahasiswa jika tersedia
        }

        // Cek apakah user adalah reviewer
        if ($user->reviewer) {
            $nip = $user->reviewer->nip; // Ambil NIP dari reviewer
        }
        
        
        // Tentukan role_name
        $role_name = $user->reviewer && $user->reviewer->role
            ? $user->reviewer->role->role_name
            : 'Mahasiswa'; // Default role jika tidak ada role reviewer

        // Ambil data beasiswa jika user adalah mahasiswa
        $beasiswa = $user->mahasiswa
            ? $user->mahasiswa->penerimaBeasiswa()->with('beasiswa')->get()
            : collect(); // Gunakan collection kosong jika bukan mahasiswa

            $mahasiswa = mahasiswa::where('user_id', $user_id)->first();
        // Kirim data ke view
        return view('pages.Pengaturan.index', compact(
            'user_img',
            'user_id',
            'email',
            'nama_depan',
            'nama_belakang',
            'phone',
            'user_img',
            'no_hp',
            'jk',
            'role_name',
            'nim', // Kirimkan NIM jika ada
            'nip', // Kirimkan NIP jika ada
            'beasiswa',// Kirimkan data beasiswa jika user adalah mahasiswa
            'mahasiswa'
        ));
    }



    /**
     * Update the specified resource in storage.
     */
    public function updatefoto(Request $request, string $id)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect('login');
        }

        // Validate the uploaded file
        $request->validate([
            'new_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate file type and size
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('new_img')) {
            // Create a new Request object for uploading the file
            $newRequest = new Request();
            
            // Set the uploaded file into the new request object
            $newRequest->files->set('file', $request->file('new_img'));

            // Set the path for storing the image (you can customize the path as needed)
            $newRequest->merge(['path' => 'foto']);

            // Call the existing uploadFileLocal method to handle the file upload
            $fileController = new FileController();
            $response = $fileController->uploadFileLocal($newRequest);

            // Get the response data from the JsonResponse
            $responseData = $response->getData(true); // Convert the JSON response to an array

            // Check if the URL was returned successfully
            if (isset($responseData['url'])) {
                // Update the user's 'foto' field with the URL from the uploadFileLocal method
                User::where('id', $id)
                    ->update([
                        'foto' => $responseData['url'] // Use the URL from the response
                    ]);

                return redirect()->route('pengaturan.index')->with('success', 'Profile updated successfully');
            } else {
                return redirect()->route('pengaturan.index')->with('error', 'Failed to upload the image');
            }
        }

        return redirect()->route('pengaturan.index')->with('error', 'Failed to update profile photo');
    }

    public function updateprofil(Request $request, string $id)
    {
        // Pastikan user terautentikasi
        if (!Auth::check()) {
            return redirect('login');
        }

        $user_id = Auth::id();

        try {
            // Cari data mahasiswa
            $mahasiswa = Mahasiswa::where('user_id', $user_id)->first();
            // Cari data reviewer
            $reviewer = Reviewer::where('user_id', $user_id)->first();

            // Jika user adalah mahasiswa, perbolehkan update seluruh profil
            if ($mahasiswa) {
                // Validasi data mahasiswa
                $request->validate([
                    'nama_depan' => 'required|string|max:255',
                    'nama_belakang' => 'required|string|max:255',
                    'jk' => 'required|string|in:Pria,Wanita',
                    'nim' => 'required|string|max:20',
                    'no_hp' => 'nullable|string|max:15',
                ]);

                // Cari user berdasarkan ID
                $user = User::findOrFail($id);

                // Update data user
                $user->update([
                    'nama_depan' => $request->input('nama_depan', $user->nama_depan),
                    'nama_belakang' => $request->input('nama_belakang', $user->nama_belakang),
                    'jenis_kelamin' => $request->input('jk', $user->jenis_kelamin),
                ]);

                // Update data mahasiswa
                $mahasiswa->update([
                    'nim' => $request->input('nim', $mahasiswa->nim),
                    'no_hp' => $request->input('no_hp', $mahasiswa->no_hp),
                ]);

                return redirect()->route('pengaturan.index')->with('success', 'Profil mahasiswa berhasil diperbarui.');
            }

            // Jika user adalah reviewer, batasi update pada data yang diperbolehkan
            if ($reviewer) {
                // Validasi data reviewer
                $request->validate([
                    'nama_depan' => 'required|string|max:255',
                    'nama_belakang' => 'required|string|max:255',
                    'jk' => 'required|string|in:Pria,Wanita',
                ]);

                // Cari user berdasarkan ID
                $user = User::findOrFail($id);

                // Update data user reviewer
                $user->update([
                    'nama_depan' => $request->input('nama_depan', $user->nama_depan),
                    'nama_belakang' => $request->input('nama_belakang', $user->nama_belakang),
                    'jenis_kelamin' => $request->input('jk', $user->jenis_kelamin),
                ]);

                return redirect()->route('pengaturan.index')->with('success', 'Profil reviewer berhasil diperbarui.');
            }

            return redirect()->route('pengaturan.index')->with('error', 'User tidak ditemukan.');

        } catch (\Exception $e) {
            return redirect()->route('pengaturan.index')->with('error', 'Terjadi kesalahan saat memperbarui profil. Silakan coba lagi. Peringatan! NIM tidak bisa diganti jika anda telah menerima beasiswa');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}