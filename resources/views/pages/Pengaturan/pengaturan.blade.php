@extends('layouts.main')
@section('content')
    @include('component.navbar')

<div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-4 sm:px-0">
        <div class="bg-white rounded-lg p-6">
            <nav>
                <ul class="flex">
                    <li>
                        <a href="#profil" class="px-4 py-2 text-gray-600 active:text-black focus:font-bold">Profil</a>
                    </li>
                    <li>
                        <a href="#notifikasi" class="px-4 py-2 text-gray-600 active:text-black focus:font-bold">Notifikasi</a>
                    </li>
                </ul>
                <hr class="h-px my-4 shadow-md bg-gray-600 border-5 dark:bg-gray-700">
            </nav>
            <section id="profil">
                <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md flex space-x-10">
                    <!-- Profile Picture and Upload Button -->
                    <div class="w-1/4 text-center">
                        <img class="w-24 h-24 rounded-full mx-auto" src="https://via.placeholder.com/100" alt="Avatar">
                        <h2 class="mt-4 text-lg font-bold">Khusan Akhmedov</h2>
                        <p class="text-gray-600">Staff Kemahasiswaan</p>
                        <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">Upload new avatar</button>
                    </div>

                    <!-- Profile Information Form -->
                    <div class="w-3/4">
                        <h3 class="text-xl font-semibold mb-4">Informasi Umum</h3>
                        <form>
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Nama Awal -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="first-name">Nama Awal</label>
                                    <input type="text" id="first-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Nama Awal">
                                </div>
                                <!-- Nama Akhir -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="last-name">Nama Akhir</label>
                                    <input type="text" id="last-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Nama Akhir">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700" for="dob">Tempat, Tanggal Lahir</label>
                                <input type="text" id="dob" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Tempat, Tanggal Lahir">
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                                <input type="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="EMAIL">
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700" for="description">Deskripsi Singkat</label>
                                <textarea id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Saya adalah..."></textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-4 mt-6">
                                <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">CANCEL</button>
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section id="notifikasi" class="hidden">
                <div class="max-w-4xl mx-auto mt-10 p-3 bg-white rounded-lg shadow-md">
                    <!-- Judul Preferensi Notifikasi -->
                    <h1 class="text-3xl font-semibold">Preferensi Notifikasi</h1>
                    <p class="text-gray-500 mt-2">Dapatkan email untuk mengetahui apa yang terjadi saat Anda tidak online. Anda dapat mengubahnya kapan saja.</p>
                    
                    <!-- Garis pemisah -->
                    <hr class="h-px my-4 shadow-md bg-gray-600 border-5 dark:bg-gray-700">
                    
                    <!-- Pengaturan Notifikasi -->
                    <h2 class="text-2xl font-semibold mb-2">Pengaturan Notifikasi</h2>
                    <p class="text-gray-500 mb-6">Dapatkan berita, pembaruan, dan tutorial industri terbaru dari kami.</p>
                    
                    <!-- Opsi Notifikasi -->
                    <div class="space-y-4">
                        <!-- Aktifkan Notifikasi -->
                        <div class="flex flex-col items-start">
                            <div class="flex items-center">
                                <input id="aktifkan" name="notification" type="radio" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                                <label for="aktifkan" class="ml-3 text-lg font-medium text-gray-900">Aktifkan Notifikasi</label>
                            </div>
                            <p class="ml-8 text-gray-500">Kirimkan saya notifikasi mengenai aktivitas update laporan beasiswa.</p>
                        </div>

                        <!-- Nonaktifkan Notifikasi -->
                        <div class="flex flex-col items-start">
                            <div class="flex items-center">
                                <input id="nonaktifkan" name="notification" type="radio" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <label for="nonaktifkan" class="ml-3 text-lg font-medium text-gray-900">Nonaktifkan Notifikasi</label>
                            </div>
                            <p class="ml-8 text-gray-500">Jangan kirimkan notifikasi pop-up.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
document.querySelector('a[href="#profil"]').addEventListener('click', function(event) {
    event.preventDefault();
    showTab('profil');
});

document.querySelector('a[href="#notifikasi"]').addEventListener('click', function(event) {
    event.preventDefault();
    showTab('notifikasi');
});

function showTab(tabId) {
    // Sembunyikan kedua tab
    document.getElementById('profil').classList.add('hidden');
    document.getElementById('notifikasi').classList.add('hidden');

    // Tampilkan tab yang dipilih
    document.getElementById(tabId).classList.remove('hidden');
}

</script>