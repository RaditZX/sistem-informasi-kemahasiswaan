@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')
@section('content')
    @include('component.navbar',['path'=>"Tracking Beasiswa > Beasiswa LKPD",'id'=>null])

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-4 sm:px-0">
            <div class="p-6">
                <!-- Navigation Tabs -->
                <nav>
                    <ul class="flex space-x-4">
                        <li>
                            <a href="#profil" class="tab-link px-4 py-2 text-gray-600 hover:text-black focus:font-bold active" data-target="profil">Profil</a>
                        </li>
                        <li>
                            <a href="#notifikasi" class="tab-link px-4 py-2 text-gray-600 hover:text-black focus:font-bold" data-target="notifikasi">Notifikasi</a>
                        </li>
                    </ul>
                    <hr class="h-px my-4 bg-gray-300 border-0 dark:bg-gray-700">
                </nav>

                <!-- Profil Section -->
                <section id="profil" class="tab-content">
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
                    <div class="max-w-4xl mx-auto p-6 rounded-lg flex">
                        <!-- Profile Picture and Upload Button -->
                        <div class="w-1/4 text-center">
                            <h2 class="text-xl font-semibold mb-4">Profile</h2>
                            <img class="w-48 h-48 rounded-full mx-auto" src="{{ asset('storage/' . $user_img) }}" alt="Avatar">
                            <h2 class="mt-4 text-lg font-bold">{{ $nama_depan . ' ' . $nama_belakang }}</h2>
                            <p class="text-gray-600">Staff Kemahasiswaan</p>
                            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="mt-4 bg-[#6B705C] text-white px-4 py-2 rounded" type="button">Ganti Foto</button> 
                        </div>
                        <div class="px-5 ml-7 inline-block h-[500px] w-0.5 self-stretch border-l-2 border-gray-300"></div>

                        <!-- Main modal -->
                        <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Ganti Foto Profil
                                        </h3>
                                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <form class="space-y-4" action="{{ route('pengaturan.update', $user_id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="new_img">File Foto</label>
                                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="new_img" name="new_img" type="file" required>
                                            </div>
                                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                                        </form>                                        
                                    </div>
                                </div>
                            </div>
                        </div>  
                        
                        <!-- Profile Information Form -->
                        <div class="w-3/4 pl-6">
                            <h3 class="text-xl font-semibold mb-4">Informasi Umum</h3>
                            <hr class="h-px my-4 bg-gray-300 border-0">
                            <form action="#" method="POST">
                                @csrf
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Nama Awal -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700" for="first-name">Nama Awal</label>
                                        <input readonly type="text" id="first-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="{{ $nama_depan }}" disabled>
                                    </div>
                                    <!-- Nama Akhir -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700" for="last-name">Nama Akhir</label>
                                        <input readonly type="text" id="last-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="{{ $nama_belakang }}" disabled>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700" for="dob">Tempat, Tanggal Lahir</label>
                                    <input readonly type="text" id="dob" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Tempat, Tanggal Lahir">
                                </div>

                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                                    <input readonly type="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="{{ $email }}" disabled>
                                </div>

                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700" for="description">Deskripsi Singkat</label>
                                    <textarea readonly id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Saya adalah..."></textarea>
                                </div>  
                            </form>
                        </div>
                    </div>
                </section>

                <!-- Notifikasi Section -->
                <section id="notifikasi" class="tab-content hidden">
                    <div class="max-w-4xl mx-auto mt-10 p-6 rounded-lg">
                        <h1 class="text-xl font-semibold">Preferensi Notifikasi</h1>
                        <p class="text-gray-500 mt-2">Dapatkan email untuk mengetahui apa yang terjadi saat Anda tidak online. Anda dapat mengubahnya kapan saja.</p>
                        <hr class="h-px my-4 bg-gray-300 border-0">
                        <h2 class="text-xl font-semibold mb-2">Pengaturan Notifikasi</h2>
                        <p class="text-gray-500 mb-6">Dapatkan berita, pembaruan, dan tutorial industri terbaru dari kami.</p>
                        
                        <!-- Notification Options -->
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <input id="aktifkan" name="notification" type="radio" class="w-5 h-5 text-blue-600 border-gray-300" checked>
                                <label for="aktifkan" class="ml-3 text-md font-medium text-gray-900">Aktifkan Notifikasi</label>
                            </div>
                            <p class="ml-8 text-gray-500">Kirimkan saya notifikasi mengenai aktivitas update laporan beasiswa.</p>

                            <div class="flex items-start mt-4">
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

        // Set the default tab to be active on page load
        document.querySelector('.tab-link').click();
    </script>
@endsection