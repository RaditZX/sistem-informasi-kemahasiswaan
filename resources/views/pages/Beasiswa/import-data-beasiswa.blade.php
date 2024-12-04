@extends('layouts.filter')
@extends('layouts.main')

@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null, 'notificationData'=>$notificationData])

    <div class="p-3 mt-3 flex flex-row">
        <p class="text-2xl lg:text-3xl font-bold text-black">Import Data Penerima Beasiswa</p>
    </div>

    <form id="uploadForm" action="{{ route('penerimabeasiswa.import-data-beasiswa') }}" method="POST" enctype="multipart/form-data" class="border border-gray-500 rounded-lg p-5 flex flex-col items-center justify-center gap-4 mr-10 ml-3 mt-8">
        @csrf
        <div id="dropArea" class="w-full h-48 border-2 border-dashed border-gray-400 rounded-lg flex flex-col justify-center items-center p-6 bg-gray-50 hover:bg-gray-100">
            <i class="fas fa-upload text-gray-500 text-3xl mb-3"></i>
            <p class="text-base font-light text-gray-500 text-center">
                Seret dan letakkan atau klik untuk mengunggah berkas
            </p>
            <input id="fileInput" name="excelFile" type="file" class="hidden" />
        </div>

        <!-- Attached Files -->
        <div id="fileList" class="w-full mt-4 text-sm text-gray-600">
            <p class="text-center" id="noFilesMessage">Tidak ada file yang terlampir.</p>
        </div>

        <!-- Buttons -->
        <div class="flex flex-row-reverse gap-4 text-center w-full mt-6">
            <button type="button" class="border border-orange-500 rounded-lg w-28 h-12 hover:bg-orange-500 hover:text-white text-orange-500">
                Cancel
            </button>
            <button type="submit" class="bg-orange-500 rounded-lg w-28 h-12 text-white hover:bg-orange-600">
                Import File
            </button>
        </div>
    </form>

    <!-- JavaScript -->
    <script>
        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');
        const noFilesMessage = document.getElementById('noFilesMessage');

        // Highlight drop area on drag over
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('bg-gray-200');
        });

        // Remove highlight on drag leave
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('bg-gray-200');
        });

        // Handle file drop
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('bg-gray-200');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        // Open file input on click
        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Handle file input change
        fileInput.addEventListener('change', (e) => {
            const files = e.target.files;
            handleFiles(files);
        });

        // Display attached files
        function handleFiles(files) {
            noFilesMessage.style.display = 'none';
            fileList.innerHTML = '';
            Array.from(files).forEach((file) => {
                const listItem = document.createElement('p');
                listItem.textContent = file.name;
                listItem.classList.add('truncate', 'mt-2', 'text-center');
                fileList.appendChild(listItem);
            });
        }

        function showAlert(type, title, message) {
            const alertOverlay = document.getElementById('alertOverlay');
            const alertPopup = document.getElementById('alertPopup');
            const alertIcon = document.getElementById('alertIcon');
            const alertTitle = document.getElementById('alertTitle');
            const alertMessage = document.getElementById('alertMessage');

            // Update title, message, and icon based on type
            alertTitle.textContent = title;
            alertMessage.textContent = message;
            alertIcon.className = 'w-10 h-10 flex items-center justify-center rounded-full';

            switch (type) {
                case 'success':
                    alertIcon.classList.add('bg-green-100', 'text-green-600');
                    alertIcon.innerHTML = '<i class="fas fa-check-circle text-2xl"></i>';
                    break;
                case 'error':
                    alertIcon.classList.add('bg-red-100', 'text-red-600');
                    alertIcon.innerHTML = '<i class="fas fa-times-circle text-2xl"></i>';
                    break;
                case 'warning':
                    alertIcon.classList.add('bg-yellow-100', 'text-yellow-600');
                    alertIcon.innerHTML = '<i class="fas fa-exclamation-circle text-2xl"></i>';
                    break;
                case 'info':
                    alertIcon.classList.add('bg-blue-100', 'text-blue-600');
                    alertIcon.innerHTML = '<i class="fas fa-info-circle text-2xl"></i>';
                    break;
            }

            // Show overlay and notification
            alertOverlay.classList.remove('hidden');

            // Automatically hide after 3 seconds
            setTimeout(() => {
                alertOverlay.classList.add('hidden');
            }, 3000);
        }

        // Close alert manually
        document.getElementById('alertClose').addEventListener('click', () => {
            document.getElementById('alertOverlay').classList.add('hidden');
        });

        // Handle form submission
        uploadForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const files = fileInput.files;
            if (files.length > 0) {
                showAlert('success', 'File Uploaded', 'File has been successfully uploaded.');
            } else {
                showAlert('error', 'No File', 'Please attach a file before uploading.');
            }
        });
    </script>
@endsection
