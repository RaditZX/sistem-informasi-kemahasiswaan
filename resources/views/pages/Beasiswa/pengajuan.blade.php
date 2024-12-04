@extends('layouts.main')

@section('content')
    @include('component.navbar', [
        'path' => 'Pengajuan Beasiswa',
        'id' => null,
        'notificationData' => $notificationData,
    ])

    <div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h2 class="text-3xl font-bold mb-6">Data Pribadi Mahasiswa</h2>

            <!-- Profile Card -->
            <div class="bg-white p-6 rounded-lg border border-gray-300 mb-6">
                <div class="flex items-center">
                    <div class="w-20 h-20 rounded-full bg-gray-300 mr-6"></div>
                    <div>
                        <h3 class="text-xl font-bold">{{ $user->nama_depan . $user->nama_belakang }}</h3>
                        <p class="text-lg text-gray-700">{{ $prodi->nama_prodi }}</p>
                        <p class="text-sm text-gray-500">{{ $jurusan->nama_jurusan }}</p>
                    </div>
                </div>
            </div>

            <!-- Student Information -->
            <div class="bg-white p-6 rounded-lg border border-gray-300 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nama Depan</label>
                        <p class="mt-1 text-base text-gray-800">{{ $user->nama_depan }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nama Belakang</label>
                        <p class="mt-1 text-base text-gray-800">{{ $user->nama_belakang }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                        <p class="mt-1 text-base text-gray-800">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nomor Telepon</label>
                        <p class="mt-1 text-base text-gray-800">{{ $mhs->no_hp }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">NIM</label>
                        <p class="mt-1 text-base text-gray-800">{{ $mhs->nim }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Status Mahasiswa</label>
                        <p class="mt-1 text-base text-gray-800">Mengikuti Perkuliahan di Kelas</p>
                    </div>
                </div>
            </div>

            <!-- Notification -->
            <div class="bg-yellow-100 p-4 border border-yellow-300 rounded-lg text-sm text-yellow-800 mb-10">
                Silakan cermati dengan seksama data pribadi Anda. Jika terdapat kekeliruan pada data pribadi Anda, silakan
                update pada menu <a href="#" class="font-medium underline">Profil Mahasiswa</a> → <span
                    class="font-medium underline">Data Pribadi</span>. Jika terdapat kekeliruan pada status mahasiswa Anda,
                silakan hubungi BAAK.
            </div>

            <!-- Title -->
            <h2 class="text-3xl font-bold mb-6">Lampiran Dokumen</h2>

            @if ($pengajuan != null && $dokumen_pengajauan != null)
                <form action="{{ route('pengajuan.edit', ['id' => request()->route('id')]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="bg-white p-6 rounded-lg border border-gray-300">
                        <!-- Kartu Tanda Mahasiswa -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(1)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Kartu Tanda Mahasiswa (KTM)</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-1">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-1" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-1" name="file_1" type="file" accept=".pdf" class="hidden"
                                        onchange="checkDocumentsUploaded()">
                                </div>
                            </div>
                        </div>

                        <!-- Curriculum Vitae -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(2)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Curriculum Vitae</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-2">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-2" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-2" name="file_2" type="file" accept=".pdf" class="hidden"
                                        onchange="checkDocumentsUploaded()">
                                </div>
                            </div>
                        </div>

                        <!-- Transkrip Nilai -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(3)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Transkrip Nilai</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-3">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-3" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-10 w-10 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-3" name="file_3" type="file" accept=".pdf"
                                        class="hidden" onchange="checkDocumentsUploaded()">
                                </div>
                            </div>
                        </div>

                        <!-- Surat Berperilaku Baik -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(4)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Surat Berperilaku Baik</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-4">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-4" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-10 w-10 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-4" name="file_4" type="file" accept=".pdf"
                                        class="hidden" onchange="checkDocumentsUploaded()">
                                </div>
                            </div>
                        </div>

                        <!-- Surat Pernyataan -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(5)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Surat Pernyataan</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-5">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-5" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-10 w-10 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-5" name="file_5" type="file" accept=".pdf"
                                        class="hidden" onchange="checkDocumentsUploaded()">
                                </div>
                            </div>

                            <div class="progress-bar" id="progress-bar-1" style="display: none;">
                                <div class="progress" id="progress-1"></div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="flex justify-center pt-36 p-6">
                            <button type="submit" id="submit-btn"
                                class="w-full bg-orange-500 text-white px-4 py-2 rounded-lg  ">Submit</button>
                        </div>
                    </div>
                </form>
            @else
                <form action="{{ route('pengajuan.store', ['id' => request()->route('id')]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="bg-white p-6 rounded-lg border border-gray-300">
                        <!-- Kartu Tanda Mahasiswa -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(1)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Kartu Tanda Mahasiswa (KTM)</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-1">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-1" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-10 w-10 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-1" name="file_1" type="file" accept=".pdf"
                                        class="hidden" onchange="checkDocumentsUploaded()">
                                </div>
                            </div>
                        </div>

                        <!-- Curriculum Vitae -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(2)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Curriculum Vitae</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-2">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-2" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-10 w-10 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-2" name="file_2" type="file" accept=".pdf"
                                        class="hidden" onchange="checkDocumentsUploaded()">
                                </div>
                            </div>
                        </div>

                        <!-- Transkrip Nilai -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(3)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Transkrip Nilai</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-3">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-3" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-10 w-10 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-3" name="file_3" type="file" accept=".pdf"
                                        class="hidden" onchange="checkDocumentsUploaded()">
                                </div>
                            </div>
                        </div>

                        <!-- Surat Berperilaku Baik -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(4)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Surat Berperilaku Baik</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-4">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-4" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-10 w-10 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-4" name="file_4" type="file" accept=".pdf"
                                        class="hidden" onchange="checkDocumentsUploaded()">
                                </div>
                            </div>
                        </div>

                        <!-- Surat Pernyataan -->
                        <div class="group">
                            <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                                onclick="toggleUpload(5)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <p class="text-gray-700">Surat Pernyataan</p>
                            </div>

                            <!-- Upload Section (Hidden by default) -->
                            <div class="hidden" id="upload-section-5">
                                <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                    <div
                                        class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                        <label for="file-upload-5" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-10 w-10 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk
                                                mengunggah
                                                berkas</p>
                                            <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                        </label>
                                    </div>
                                    <input id="file-upload-5" name="file_5" type="file" accept=".pdf"
                                        class="hidden" onchange="checkDocumentsUploaded()">
                                </div>
                            </div>

                            <div class="progress-bar" id="progress-bar-1" style="display: none;">
                                <div class="progress" id="progress-1"></div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="flex justify-center pt-36 p-6">
                            <button type="submit" id="submit-btn"
                                class="w-full bg-orange-500 text-white px-4 py-2 rounded-lg  ">Submit</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <style>
        .upload-section {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            margin: 10px 0;
        }

        .progress-bar {
            width: 100%;
            background-color: #f3f3f3;
            border: 1px solid #ccc;
        }

        .progress {
            height: 20px;
            background-color: #4caf50;
            width: 0;
        }
    </style>

    <script>
        function toggleUpload(sectionNumber) {
            const uploadSection = document.getElementById(`upload-section-${sectionNumber}`);
            const progressBarContainer = document.getElementById(`progress-bar-container-${sectionNumber}`);
            uploadSection.classList.toggle('hidden');
            progressBarContainer.classList.add('hidden'); // Hide progress bar by default
        }

        function checkDocumentsUploaded() {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            const formData = new FormData();

            let filesToUpload = false;

            // Get values of beasiswa_id and nim from input fields
            const beasiswaId = 1;
            const nim = 123456789;

            // Append beasiswa_id and nim to formData
            formData.append('beasiswa_id', beasiswaId);
            formData.append('nim', nim);

            fileInputs.forEach((input, index) => {
                if (input.files.length > 0) {
                    const progressBarContainer = document.getElementById(`progress-bar-container-${index + 1}`);
                    progressBarContainer.classList.remove('hidden'); // Show progress bar

                    // Append each file to the FormData object
                    Array.from(input.files).forEach(file => {
                        formData.append('files[]', file); // Use 'files[]' for multiple file uploads
                        filesToUpload = true; // Mark that we have files to upload
                    });
                }
            });

            if (filesToUpload) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/pengajuan/store'); // Update with your upload endpoint

                xhr.upload.addEventListener('progress', (event) => {
                    if (event.lengthComputable) {
                        const percentComplete = (event.loaded / event.total) * 100;
                        const progressBar = document.getElementById(
                        `progress-1`); // Assuming you have one progress bar
                        const progressText = document.getElementById(`progress-text-1`);

                        progressBar.style.width = percentComplete + '%';
                        progressText.innerText = Math.round(percentComplete) + '%';
                    }
                });

                xhr.onload = () => {
                    if (xhr.status === 200) {
                        // Handle success response
                        alert('Files uploaded successfully!');
                    } else {
                        // Handle error response
                        alert('File upload failed: ' + xhr.responseText);
                    }
                };

                xhr.onerror = () => {
                    alert('An error occurred during the upload.');
                };

                xhr.send(formData);
            } else {
                alert('No files selected for upload.');
            }
        }

        document.getElementById('file-upload-1').addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file && file.type === 'application/pdf') {
                const uploadSection = document.getElementById('upload-section-1');
                uploadSection.style.display = 'none'; // Hide upload section
            } else {
                alert('Harap pilih file PDF.');
            }
        });
    </script>
@endsection
