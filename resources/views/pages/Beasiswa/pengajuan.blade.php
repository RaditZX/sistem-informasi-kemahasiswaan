@extends('layouts.main')

@section('content')
    @include('component.navbar', ['path' => 'Pengajuan Beasiswa', 'id' => null, 'notificationData'=>$notificationData])


    <div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="container px-4 py-6 sm:px-0">
            <h2 class="text-3xl font-bold mb-6">Data Pribadi Mahasiswa</h2>

            <!-- Profile Card -->
            <div class="bg-white p-6 border-2 border-t-0 border-r-0 border-l-0 border-orange-300 mb-6">
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
            <div class="container p-6">
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

            <form action="{{ route('pengajuan.store',['id' => request()->route('id')]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="bg-white p-6 rounded-lg border border-gray-300">
                    <!-- Kartu Tanda Mahasiswa -->
                    <div class="group">
                        <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                            onclick="toggleUpload(1)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <p class="text-gray-700">Kartu Tanda Mahasiswa (KTM)</p>
                        </div>

                        <!-- Upload Section (Hidden by default) -->
                        <div class="hidden" id="upload-section-1">
                            <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                    <label for="file-upload-1" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <p class="text-gray-700">Curriculum Vitae</p>
                        </div>

                        <!-- Upload Section (Hidden by default) -->
                        <div class="hidden" id="upload-section-2">
                            <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                    <label for="file-upload-2" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <p class="text-gray-700">Transkrip Nilai</p>
                        </div>

                        <!-- Upload Section (Hidden by default) -->
                        <div class="hidden" id="upload-section-3">
                            <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                <div
                                    class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                    <label for="file-upload-3" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah
                                            berkas</p>
                                        <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                    </label>
                                </div>
                                <input id="file-upload-3" name="file_3" type="file" accept=".pdf" class="hidden"
                                    onchange="checkDocumentsUploaded()">
                            </div>
                        </div>
                    </div>

                    <!-- Surat Berperilaku Baik -->
                    <div class="group">
                        <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                            onclick="toggleUpload(4)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <p class="text-gray-700">Surat Berperilaku Baik</p>
                        </div>

                        <!-- Upload Section (Hidden by default) -->
                        <div class="hidden" id="upload-section-4">
                            <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                <div
                                    class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                    <label for="file-upload-4" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah
                                            berkas</p>
                                        <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                    </label>
                                </div>
                                <input id="file-upload-4" name="file_4" type="file" accept=".pdf" class="hidden"
                                    onchange="checkDocumentsUploaded()">
                            </div>
                        </div>
                    </div>

                    <!-- Surat Pernyataan -->
                    <div class="group">
                        <div class="flex items-center p-4 border border-black rounded-lg relative cursor-pointer mx-6 mt-12"
                            onclick="toggleUpload(5)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <p class="text-gray-700">Surat Pernyataan</p>
                        </div>

                        <!-- Upload Section (Hidden by default) -->
                        <div class="hidden" id="upload-section-5">
                            <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                                <div
                                    class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                    <label for="file-upload-5" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah
                                            berkas</p>
                                        <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                    </label>
                                </div>
                                <input id="file-upload-5" name="file_5" type="file" accept=".pdf" class="hidden"
                                    onchange="checkDocumentsUploaded()" >
                            </div>
                        </div>

                        <div class="progress-bar" id="progress-bar-1" style="display: none;">
                            <div class="progress" id="progress-1"></div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="flex justify-center pt-36 p-6">
                        <button type="submit" id="submit-btn"
                            class="w-full bg-orange-500 text-white px-4 py-2 rounded-lg  "
                            >Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>



    <script>
        // Function to toggle visibility of the upload section and initially hide the progress bar
        function toggleUpload(section) {
            // Menampilkan atau menyembunyikan bagian upload berdasarkan section yang diklik
            const uploadSection = document.getElementById(`upload-section-${section}`);
            uploadSection.classList.toggle('hidden');

            // Menyembunyikan file display dan progress bar ketika upload section ditampilkan
            const fileDisplay = document.getElementById(`file-display-${section}`);
            const progressBar = document.getElementById(`progress-bar-container-${section}`);
            fileDisplay.classList.add('hidden');
            progressBar.style.display = 'none';
        }

        function uploadFile(section) {
            const fileInput = document.getElementById(`file-upload-${section}`);
            const fileNameDisplay = document.getElementById(`file-name-display-${section}`);
            const fileDisplay = document.getElementById(`file-display-${section}`);
            const progressBar = document.getElementById(`progress-bar-container-${section}`);
            const progress = document.getElementById(`progress-${section}`);

            const file = fileInput.files[0];
            if (file) {
                // Menampilkan nama file yang di-upload
                fileNameDisplay.textContent = file.name;
                fileDisplay.classList.remove('hidden');

                // Menampilkan progress bar
                progressBar.style.display = 'flex';

                // Simulasi upload dengan progress
                let progressValue = 0;
                let interval = setInterval(() => {
                    progressValue += 10;
                    if (progressValue >= 100) {
                        clearInterval(interval);
                    }
                    progress.style.width = `${progressValue}%`;
                }, 20); // Progress bertambah setiap 500ms
            }


            // If there are files to upload, proceed with the XMLHttpRequest
            if (filesToUpload) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/pengajuan/store'); // Update with your actual upload endpoint

                // Show progress for each file upload
                xhr.upload.addEventListener('progress', (event) => {
                    if (event.lengthComputable) {
                        const percentComplete = (event.loaded / event.total) * 100;
                        const progressBar = document.getElementById(`progress-1`); // Assuming you have one progress bar
                        const progressText = document.getElementById(`progress-text-1`);

                        // Update progress bars for each section
                        fileInputs.forEach((_, index) => {
                            const progressBar = document.getElementById(`progress-${index + 1}`);
                            const progressText = document.getElementById(`progress-text-${index + 1}`);
                            progressBar.style.width = percentComplete + '%';
                            progressText.innerText = Math.round(percentComplete) + '%';
                        });
                    }
                });

                // Handle successful upload response
                xhr.onload = () => {
                    if (xhr.status === 200) {
                        fileInputs.forEach((_, index) => {
                            const progressBar = document.getElementById(`progress-${index + 1}`);
                            progressBar.style.width = '100%'; // Ensure the progress bar is filled
                        });
                        alert('Files uploaded successfully!');
                    } else {
                        alert('File upload failed: ' + xhr.responseText);
                    }
                };

                // Handle upload error
                xhr.onerror = () => {
                    alert('An error occurred during the upload.');
                };

                // Send the FormData object with the files
                xhr.send(formData);
            } else {
                alert('No files selected for upload.');
            }
        }

        function viewFile(id) {
            // Mengambil nama file atau path file berdasarkan ID
            const filePath = document.getElementById(`file-name-display-${id}`).innerText;

            // Mengatur src iframe ke path file PDF yang di-upload
            const pdfIframe = document.getElementById('pdf-iframe');
            pdfIframe.src = `/storage/uploads/${filePath}`; // Sesuaikan dengan path file yang disimpan di server

            // Menampilkan modal PDF viewer
            const pdfViewer = document.getElementById('pdf-viewer');
            pdfViewer.classList.remove('hidden');
        }

        function closePdfViewer() {
            const pdfViewer = document.getElementById('pdf-viewer');
            pdfViewer.classList.add('hidden');
            const pdfIframe = document.getElementById('pdf-iframe');
            pdfIframe.src = '';
        }

        function deleteFile(fileNumber) {
            // Reset progress bar
            document.getElementById('progress-' + fileNumber).style.width = '0%';

            // Sembunyikan elemen file display dan progress bar
            document.getElementById('file-display-' + fileNumber).classList.add('hidden');
            document.getElementById('progress-bar-container-' + fileNumber).classList.add('hidden');

            // Tampilkan kembali upload section
            document.getElementById('upload-section-' + fileNumber).classList.remove('hidden');

            // Ganti input file dengan elemen baru untuk reset penuh
            const oldInput = document.getElementById('file-upload-' + fileNumber);
            const newInput = oldInput.cloneNode(true); // Buat elemen baru dengan atribut yang sama
            oldInput.parentNode.replaceChild(newInput, oldInput);

            // Tambahkan kembali event listener untuk elemen input baru
            newInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file && file.type === 'application/pdf') {
                    // Tampilkan progress bar dan sembunyikan upload section
                    const uploadSection = document.getElementById(`upload-section-${fileNumber}`);
                    uploadSection.classList.add('hidden');
                    const progressBarContainer = document.getElementById(`progress-bar-container-${fileNumber}`);
                    progressBarContainer.classList.remove('hidden');

                    // Simulasikan unggahan dengan progress
                    simulateUpload(fileNumber, file.name);
                } else {
                    // Beri peringatan jika file bukan PDF
                    alert('Harap unggah file dengan format PDF.');
                    event.target.value = ''; // Hapus seleksi file
                }
            });
        }



        // Set up file input change event listener to validate for PDF and hide upload section if file is valid
        document.querySelectorAll('input[type="file"]').forEach((input, index) => {
            input.addEventListener('change', function(event) {
                const file = event.target.files[0];

                if (file && file.type === 'application/pdf') {
                    const uploadSection = document.getElementById(`upload-section-${index + 1}`);
                    uploadSection.style.display = 'none'; // Hide upload section after PDF selection
                    const progressBarContainer = document.getElementById(`progress-bar-container-${index + 1}`);
                    progressBarContainer.classList.remove('hidden'); // Show progress bar when PDF is selected
                } else {
                    alert('Please select a PDF file.');
                    event.target.value = ''; // Clear selection if not a PDF
                }
            });
        });
    </script>
@endsection
