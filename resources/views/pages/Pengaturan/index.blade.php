@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')

@section('content')
@include('component.navbar', ['path' => 'Pengaturan', 'id' => null, 'notificationData' => $notificationData])

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Flash Message Section -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="px-4 py-4 sm:px-0">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <!-- Navigation Tabs -->
            <nav class="">
                <ul class="flex space-x-6">
                    <li>
                        <a href="#profil" class="tab-link active text-lg font-semibold text-gray-700 hover:text-blue-600 py-2 px-4 transition duration-300 ease-in-out" data-target="profil">
                            Profil
                        </a>
                    </li>
                    <li>
                        <a href="#notifikasi" class="tab-link text-lg font-semibold text-gray-700 hover:text-blue-600 py-2 px-4 transition duration-300 ease-in-out" data-target="notifikasi">
                            Notifikasi
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="mt-6">
                <!-- Profil Section -->
                <section id="profil" class="tab-content">
                    <div class="flex items-center space-x-6">
                        <!-- Profile Picture -->
                        <div class="w-1/4 text-center">
                            <h2 class="text-xl font-semibold mb-4">Profile</h2>
                            <img src="{{ $user_img }}" alt="Avatar" class="rounded-full w-24 h-24 mx-auto">
                            <h2 class="mt-4 text-lg font-bold">{{ $nama_depan . ' ' . $nama_belakang }}</h2>
                            <p class="text-gray-600">{{ $role_name }}</p>
                            <button data-modal-target="change-photo-modal" data-modal-toggle="change-photo-modal" class="mt-4 bg-[#6B705C] text-white px-4 py-2 rounded" type="button">
                                Ganti Foto
                            </button>
                        </div>

                        <!-- Change Photo Modal -->
                        <div id="change-photo-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 w-full h-full flex justify-center items-center">
                            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                                <div class="flex items-center justify-between border-b pb-4">
                                    <h3 class="text-xl font-semibold">Ganti Foto Profil</h3>
                                    <button type="button" data-modal-hide="change-photo-modal" class="text-gray-400 hover:bg-gray-200 p-2 rounded-lg">
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <form action="{{ route('pengaturan.updatefoto', $user_id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mt-4">
                                        <label for="new_img" class="block text-sm font-medium">File Foto</label>
                                        <input id="new_img" name="new_img" type="file" class="block w-full mt-2 text-sm">
                                    </div>
                                    <div class="mt-6">
                                        <button type="submit" class="w-full bg-blue-700 text-white py-2 rounded-lg">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Profile Details -->
                        <div class="w-3/4">
                            <h3 class="text-xl font-semibold mb-4">Informasi Umum</h3>
                            <form>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium">Nama Depan</label>
                                        <input readonly type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2" value="{{ $nama_depan }}">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium">Nama Belakang</label>
                                        <input readonly type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2" value="{{ $nama_belakang }}">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-6 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium">NIM</label>
                                        <input readonly type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2" value="{{ $nim ?: $nip }}">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium">Jenis Kelamin</label>
                                        <input readonly type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2" value="{{ $jk }}">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label class="block text-sm font-medium">Email</label>
                                    <input readonly type="email" class="w-full border-gray-300 rounded-md shadow-sm p-2" value="{{ $email }}">
                                </div>
                                <div class="mt-4">
                                    <label class="block text-sm font-medium">Nomor Handphone</label>
                                    <input readonly type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2" value="{{ $no_hp ?? 'Belum diisi' }}">
                                </div>
                                <button data-modal-target="edit-profile-modal" data-modal-toggle="edit-profile-modal" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Edit Profil</button>
                            </form>
                        </div>
                    </div>

                    <!-- Edit Profile Modal -->
                    <div id="edit-profile-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 w-full h-full flex justify-center items-center">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                            <div class="flex items-center justify-between border-b pb-4">
                                <h3 class="text-xl font-semibold">Edit Profil</h3>
                                <button type="button" data-modal-hide="edit-profile-modal" class="text-gray-400 hover:bg-gray-200 p-2 rounded-lg">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <form action="{{ route('pengaturan.updateprofil', $user_id) }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="mt-4">
                                    <label for="nama_depan" class="block text-sm font-medium">Nama Depan</label>
                                    <input id="nama_depan" name="nama_depan" type="text" class="block w-full mt-2 text-sm border-gray-300 rounded-md shadow-sm" value="{{ $nama_depan }}">
                                </div>
                                <div class="mt-4">
                                    <label for="nama_belakang" class="block text-sm font-medium">Nama Belakang</label>
                                    <input id="nama_belakang" name="nama_belakang" type="text" class="block w-full mt-2 text-sm border-gray-300 rounded-md shadow-sm" value="{{ $nama_belakang }}">
                                </div>

                                <div class="mt-4">
                                    <label for="jk" class="block text-sm font-medium">Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="block w-full mt-2 text-sm border-gray-300 rounded-md shadow-sm">
                                        <option value="Pria" {{ old('jk', $jk) == 'Pria' ? 'selected' : '' }}>Pria</option>
                                        <option value="Wanita" {{ old('jk', $jk) == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                                    </select>
                                </div>

                                <!-- Hanya tampilkan input NIM jika user adalah mahasiswa -->
                                @if($mahasiswa)
                                    <div class="mt-4">
                                        <label for="nim" class="block text-sm font-medium">NIM</label>
                                        <input id="nim" name="nim" type="text" class="block w-full mt-2 text-sm border-gray-300 rounded-md shadow-sm" value="{{ $nim }}">
                                    </div>
                                

                                <div class="mt-4">
                                    <label for="no_hp" class="block text-sm font-medium">Nomor Handphone</label>
                                    <input id="no_hp" name="no_hp" type="text" class="block w-full mt-2 text-sm border-gray-300 rounded-md shadow-sm" value="{{ $no_hp ?? '' }}">
                                </div>
                                @endif

                                <div class="mt-6">
                                    <button type="submit" class="w-full bg-blue-700 text-white py-2 rounded-lg">Simpan Perubahan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                

                <!-- Beasiswa Section -->
                @if($mahasiswa)
                @if($beasiswa->isNotEmpty())
                    <h3 class="mt-8 font-semibold text-2xl text-center m-5">Beasiswa yang Diterima</h3>
                    <div class="bg-gray-100 p-4 rounded-md shadow-sm">
                        <ul class="space-y-4">
                            @foreach($beasiswa as $item)
                                <li class="flex justify-between items-center p-4 bg-white rounded-lg shadow-sm">
                                    <div>
                                        <h4 class="font-semibold text-gray-800 text-xl">{{ $item->beasiswa->nama_beasiswa }}</h4>
                                        <p class="text-gray-600 text-xl">Jenis: <span class="font-medium">{{ $item->beasiswa->jenis_beasiswa }}</span></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-500 text-xl">Diterima pada: <span class="font-medium">{{ $item->beasiswa->created_at->format('d M Y') }}</span></p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                <p class="mt-5 text-gray-600 text-center text-lg font-semibold py-3 px-6 border border-blue-500 rounded-lg bg-blue-100">
    Anda belum menerima beasiswa.
</p>
                @endif
                @endif
                </section>
                <!-- Notifikasi Section -->
                
            </div>
            <section id="notifikasi" class="tab-content hidden mt-10">
                    <div class="max-w-4xl mx-auto p-6 rounded-lg bg-white shadow-md">
                        <h1 class="text-xl font-semibold">Preferensi Notifikasi</h1>
                        <p class="text-gray-500 mt-2">Dapatkan email untuk mengetahui apa yang terjadi saat Anda tidak online. Anda dapat mengubahnya kapan saja.</p>
                        <hr class="my-6">

                        <h2 class="text-xl font-semibold mb-4">Pengaturan Notifikasi</h2>
                        <p class="text-gray-500 mb-6">Dapatkan berita, pembaruan, dan tutorial industri terbaru dari kami.</p>

                        <div class="space-y-6">
                            <div class="flex items-center">
                                <input id="aktifkan" name="notification" type="radio" class="w-5 h-5 text-blue-600 border-gray-300" checked>
                                <label for="aktifkan" class="ml-3 text-md font-medium text-gray-900">Aktifkan Notifikasi</label>
                            </div>
                            <p class="ml-8 text-gray-500">Kirimkan saya notifikasi mengenai aktivitas update laporan beasiswa.</p>

                            <div class="flex items-center">
                                <input id="nonaktifkan" name="notification" type="radio" class="w-5 h-5 text-blue-600 border-gray-300">
                                <label for="nonaktifkan" class="ml-3 text-md font-medium text-gray-900">Nonaktifkan Notifikasi</label>
                            </div>
                            <p class="ml-8 text-gray-500">Jangan kirimkan notifikasi pop-up.</p>
                        </div>
                    </div>
                </section>
        </div>
    </div>
</div>

<script>
    // JavaScript for handling tab switching
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const target = this.getAttribute('data-target');

            // Remove 'active' class from all links
            document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active', 'font-bold'));

            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));

            // Show the targeted tab content and set active state
            document.getElementById(target).classList.remove('hidden');
            this.classList.add('active', 'font-bold');
        });
    });
    document.querySelectorAll('[data-modal-toggle]').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const target = this.getAttribute('data-modal-target');
        const modal = document.getElementById(target);
        console.log(modal); // Debugging output
        modal.classList.toggle('hidden');
    });
});
// Menampilkan modal
document.querySelector('[data-modal-show="change-photo-modal"]').addEventListener('click', () => {
    document.getElementById('change-photo-modal').classList.remove('hidden');
});

// Menutup modal
document.querySelector('[data-modal-hide="change-photo-modal"]').addEventListener('click', () => {
    document.getElementById('change-photo-modal').classList.add('hidden');
});



    // Set the default tab to be active on page load
    document.querySelector('.tab-link').click();
    
</script>
@endsection