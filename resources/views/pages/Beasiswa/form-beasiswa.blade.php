@extends('layouts.main2')
@section('content')
    @include('component.navbar',['path'=>"Tambah Beasiswa",'id'=>null, 'notificationData'=>$notificationData])


@if ($beasiswa != null)
    <div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white rounded-lg p-6">
            <form action="{{ url("beasiswa/$beasiswa->id") }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Nama Beasiswa -->
                        <div>
                            <label for="nama_beasiswa" class="block text-sm font-medium text-gray-700">Nama POLBAN Beasiswa</label>
                            <input type="text" id="nama_beasiswa" name="nama_beasiswa" value="{{old('nama_beasiswa',$beasiswa->nama_beasiswa)}}" placeholder="Nama Beasiswa"
                                class="block w-full border @error('nama_beasiswa') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                            @error('nama_beasiswa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sumber Beasiswa -->
                        <div>
                            <label for="sumber_beasiswa" class="block text-sm font-medium text-gray-700">Sumber Beasiswa</label>
                            <input type="text" id="sumber_beasiswa" name="sumber_beasiswa" value="{{old('sumber_beasiswa', $beasiswa->sumber)}}" placeholder="Sumber Beasiswa"
                                class="block w-full border @error('sumber_beasiswa') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                            @error('sumber_beasiswa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Beasiswa</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full px-3 py-2 border @error('deskripsi') border-red-500 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo old('deskripsi', $beasiswa->deskripsi)?></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <p class="block text-sm font-medium text-gray-700">Jenis Beasiswa</p>
                            <div class="mb-4">
                                <label for="full" class="flex items-center space-x-3">
                                    <input type="radio" id="full" name="jenis_beasiswa" value="full" class="form-radio h-5 w-5 text-blue-500 rounded-full focus:ring-blue-500"
                                    @checked(old('jenis_beasiswa', $beasiswa->jenis_beasiswa) == "full")>
                                    <span class="text-gray-600">Full</span>
                                </label>
                            </div>
                        <div class="mb-4">
                            <label for="half" class="flex items-center space-x-3">
                                <input type="radio" id="half" name="jenis_beasiswa" value="setengah" class="form-radio h-5 w-5 text-blue-500 rounded-full focus:ring-blue-500"
                                @checked(old('jenis_beasiswa', $beasiswa->jenis_beasiswa) == "setengah")>
                                <span class="text-gray-600">Half</span>
                            </label>
                        </div>
                    </div>
                </div>
                <p class="block text-sm font-medium text-gray-700">Tipe Beasiswa</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="mb-4">
                        <label for="internal" class="flex items-center space-x-3">
                            <input type="radio" id="internal" name="tipe_beasiswa" value="internal"
                                class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                {{ old('tipe_beasiswa') == 'internal' ? 'checked' : '' }}>
                            <span class="text-gray-600">Internal</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label for="kipk" class="flex items-center space-x-3">
                            <input type="radio" id="kipk" name="tipe_beasiswa" value="kipk"
                                class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                {{ old('tipe_beasiswa') == 'kipk' ? 'checked' : '' }}>
                            <span class="text-gray-600">KIPK</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label for="eksternal" class="flex items-center space-x-3">
                            <input type="radio" id="eksternal" name="tipe_beasiswa" value="eksternal"
                                class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                {{ old('tipe_beasiswa') == 'eksternal' ? 'checked' : '' }}>
                            <span class="text-gray-600">Eksternal</span>
                        </label>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <div class="relative mt-1">
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{old('tanggal_mulai', $beasiswa->tanggal_mulai)}}"
                                class="block w-full border @error('tanggal_mulai') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                        </div>
                        @error('tanggal_mulai')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Berakhir -->
                    <div>
                        <label for="tanggal_berakhir" class="block text-sm font-medium text-gray-700">Tanggal Berakhir</label>
                        <div class="relative mt-1">
                            <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" value="{{old('tanggal_berakhir', $beasiswa->tanggal_berakhir)}}"
                            class="block w-full border @error('tanggal_berakhir') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                        </div>
                        @error('tanggal_berakhir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Kuota Beasiswa -->
                <div>
                    <label for="kuota_beasiswa" class="block text-sm font-medium text-gray-700">Kuota Beasiswa</label>
                    <input type="number" id="kuota_beasiswa" name="kuota_beasiswa" placeholder="Kuota Beasiswa" value="{{old('kuota_beasiswa',$beasiswa->kuota)}}"
                        class="block w-full border @error('kuota_beasiswa') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                    @error('kuota_beasiswa')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <br>

                <!-- Jenjang Pendidikan -->
                <div class="relative">
                    <label for="jenjang_pendidikan" class="block text-sm font-medium text-gray-700">Jenjang Pendidikan</label>
                    <div id="selected-tags-jenjang" class="flex flex-wrap gap-2 mb-2"></div>
                    <input type="search" id="jenjang_pendidikan" name="jenjang_pendidikan" placeholder="Jenjang Pendidikan"
                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                    oninput="fetchJenjangTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); }">
                    <div id="jenjang-suggestions" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto "></div>
                    <div id="tag-counter-jenjang" class="mb-2 text-sm text-gray-600">Jumlah jenjang yang dipilih: 0</div>
                </div>

                <!-- Syarat Beasiswa -->
                <div class="relative">
                    <label for="syarat_beasiswa" class="block text-sm font-medium text-gray-700">Syarat-Syarat Beasiswa</label>
                    <div id="selected-tags-beasiswa" class="flex flex-wrap gap-2 mb-2"></div>
                    <input type="search" id="syarat_beasiswa" name="syarat_beasiswa" placeholder="Syarat-syarat Beasiswa"
                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                    oninput="fetchBeasiswaTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); addBeasiswaTag(this.value); this.nextElementSibling.classList.add('hidden');}">
                    <div id="syarat-suggestions-beasiswa" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                    <div id="tag-counter-beasiswa" class="mb-2 text-sm text-gray-600">Jumlah syarat yang dipilih: 0</div>
                </div>

                <!-- Syarat Dokumen Beasiswa -->
                <div class="relative">
                    <label for="syarat_dokumen" class="block text-sm font-medium text-gray-700">Syarat-Syarat Dokumen Beasiswa</label>
                    <div id="selected-tags-dokumen" class="flex flex-wrap gap-2 mb-2"></div>
                    <input type="search" id="syarat_dokumen" name="syarat_dokumen" placeholder="Syarat-syarat Dokumen"
                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                    oninput="fetchDokumenTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); addDokumenTag(this.value); this.nextElementSibling.classList.add('hidden');}">
                    <div id="syarat-suggestions-dokumen" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                    <div id="tag-counter-dokumen" class="mb-2 text-sm text-gray-600">Jumlah syarat dokumen yang dipilih: 0</div>
                </div>

                <!-- Benefit Beasiswa -->
                <div class="relative">
                    <label for="benefit_beasiswa" class="block text-sm font-medium text-gray-700">Benefit Beasiswa</label>
                    <div id="selected-tags-benefit" class="flex flex-wrap gap-2 mb-2"></div>
                    <input type="search" id="benefit_beasiswa" name="benefit_beasiswa" placeholder="Benefit Beasiswa"
                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                    oninput="fetchBenefitTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); addBenefitTag(this.value); this.nextElementSibling.classList.add('hidden');}">
                    <div id="benefit-suggestions-beasiswa" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                    <div id="tag-counter-benefit" class="mb-2 text-sm text-gray-600">Jumlah benefit yang dipilih: 0</div>
                </div>

                <script>
                    let jenjang_tags = [];
                    let syarat_tags = [];
                    let benefit_tags = [];
                    let dokumen_tags = [];
                    // Fetch tags for jenjang pendidikan
                    function fetchJenjangTags() {
                        let query = $('#jenjang_pendidikan').val().trim();
                        if (query === '') {
                            $('#jenjang-suggestions').addClass('hidden');
                            return;
                        }
                        $.ajax({
                            url: "{{ route('Beasiswa.search_jenjang') }}",
                            type: 'GET',
                            data: { query: query },
                            success: function(tags) {
                                let suggestions = $('#jenjang-suggestions').empty().removeClass('hidden');
                                if (!tags.length) {
                                    suggestions.addClass('hidden');
                                    return;
                                }
                                tags.forEach(tag => {
                                    suggestions.append(`
                                        <div class="tag-suggestion px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                                            ${tag.nama_prodi}
                                        </div>
                                    `);
                                });
                                $('.tag-suggestion').on('click', function() {
                                    addJenjangTag($(this).text());
                                    suggestions.empty().addClass('hidden');
                                });
                            }
                        });
                    }

                    // Add tag for jenjang pendidikan
                    function addJenjangTag(tagText) {
                        if (jenjang_tags.includes(tagText)) {
                            $('#jenjang_pendidikan').val('');
                            return;
                        }

                        if (tagText === ''){
                            return;
                        }

                        // Tambahkan tag ke array dan ke UI
                        jenjang_tags.push(tagText);

                        let tagContainer = $('#selected-tags-jenjang');
                        tagContainer.append(`
                            <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                                ${tagText}
                                <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="$(this).parent().remove(); updateJenjangCounter();">×</span>
                            </div>
                        `);
                        tagContainer.append(`<input type="hidden" name="jenjang_pendidikan[]" value="${tagText}">`);
                        updateJenjangCounter();
                        $('#jenjang_pendidikan').val('');
                    }

                    function updateJenjangCounter() {
                        let count = $('#selected-tags-jenjang input[type="hidden"]').length;
                        $('#tag-counter-jenjang').text(`Jumlah jenjang yang dipilih: ${count}`);
                    }
                    
                    // Fetch tags for beasiswa
                    function fetchBeasiswaTags() {
                        let query = $('#syarat_beasiswa').val().trim();
                        if (query === '') {
                            $('#syarat-suggestions-beasiswa').addClass('hidden');
                            return;
                        }
                        $.ajax({
                            url: "{{ route('Beasiswa.search_syarat') }}",
                            type: 'GET',
                            data: { query: query },
                            success: function(tags) {
                                let suggestions = $('#syarat-suggestions-beasiswa').empty().removeClass('hidden');
                                if (!tags.length) {
                                    suggestions.addClass('hidden');
                                    return;
                                }
                                tags.forEach(tag => {
                                    suggestions.append(`
                                        <div class="tag-suggestion px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                                            ${tag.syarat}
                                        </div>
                                    `);
                                });
                                $('.tag-suggestion').on('click', function() {
                                    addBeasiswaTag($(this).text());
                                    suggestions.empty().addClass('hidden');
                                });
                            }
                        });
                    }

                    // Add tag for beasiswa
                    function addBeasiswaTag(tagText) {
                        if (syarat_tags.includes(tagText)) {
                            $('#syarat_beasiswa').val('');
                            return;
                        }

                        if (tagText === ''){
                            return;
                        }
                        // Tambahkan tag ke array dan ke UI
                        syarat_tags.push(tagText);

                        let tagContainer = $('#selected-tags-beasiswa');
                        tagContainer.append(`
                            <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                                ${tagText}
                                <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="$(this).parent().remove(); updateBeasiswaCounter();">×</span>
                            </div>
                        `);
                        tagContainer.append(`<input type="hidden" name="syarat_beasiswa[]" value="${tagText}">`);
                        updateBeasiswaCounter();
                        $('#syarat_beasiswa').val('');
                    }

                    function updateBeasiswaCounter() {
                        let count = $('#selected-tags-beasiswa input[type="hidden"]').length;
                        $('#tag-counter-beasiswa').text(`Jumlah syarat yang dipilih: ${count}`);
                    }

                    // Similar functions for dokumen
                    function fetchDokumenTags() {
                        let query = $('#syarat_dokumen').val().trim();
                        if (query === '') {
                            $('#syarat-suggestions-dokumen').addClass('hidden');
                            return;
                        }
                        $.ajax({
                            url: "{{ route('Beasiswa.search_dokumen') }}",
                            type: 'GET',
                            data: { query: query },
                            success: function(tags) {
                                let suggestions = $('#syarat-suggestions-dokumen').empty().removeClass('hidden');
                                if (!tags.length) {
                                    suggestions.addClass('hidden');
                                    return;
                                }
                                tags.forEach(tag => {
                                    suggestions.append(`
                                        <div class="tag-suggestion px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                                            ${tag.dokumen}
                                        </div>
                                    `);
                                });
                                $('.tag-suggestion').on('click', function() {
                                    addDokumenTag($(this).text());
                                    suggestions.empty().addClass('hidden');
                                });
                            }
                        });
                    }

                    function addDokumenTag(tagText) {
                        if (dokumen_tags.includes(tagText)) {
                            $('#syarat_dokumen').val('');
                            return;
                        }
                        if (tagText === ''){
                            return;
                        }

                        // Tambahkan tag ke array dan ke UI
                        dokumen_tags.push(tagText);

                        let tagContainer = $('#selected-tags-dokumen');
                        tagContainer.append(`
                            <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                                ${tagText}
                                <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="$(this).parent().remove(); updateDokumenCounter();">×</span>
                            </div>
                        `);
                        tagContainer.append(`<input type="hidden" name="syarat_dokumen[]" value="${tagText}">`);
                        updateDokumenCounter();
                        $('#syarat_dokumen').val('');
                    }

                    function updateDokumenCounter() {
                        let count = $('#selected-tags-dokumen input[type="hidden"]').length;
                        $('#tag-counter-dokumen').text(`Jumlah syarat dokumen yang dipilih: ${count}`);
                    }

                    // Fetch tags for benefit
                    function fetchBenefitTags() {
                        let query = $('#benefit_beasiswa').val().trim();
                        if (query === '') {
                            $('#benefit-suggestions-beasiswa').addClass('hidden');
                            return;
                        }
                        $.ajax({
                            url: "{{ route('Beasiswa.search_benefit') }}",
                            type: 'GET',
                            data: { query: query },
                            success: function(tags) {
                                let suggestions = $('#benefit-suggestions-beasiswa').empty().removeClass('hidden');
                                if (!tags.length) {
                                    suggestions.addClass('hidden');
                                    return;
                                }
                                tags.forEach(tag => {
                                    suggestions.append(`
                                        <div class="tag-suggestion px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                                            ${tag.benefit}
                                        </div>
                                    `);
                                });
                                $('.tag-suggestion').on('click', function() {
                                    addBenefitTag($(this).text());
                                    suggestions.empty().addClass('hidden');
                                });
                            }
                        });
                    }

                    // Add tag for benefit
                    function addBenefitTag(tagText) {
                        if (benefit_tags.includes(tagText)) {
                            $('#benefit_beasiswa').val('');
                            return;
                        }

                        
                        // Tambahkan tag ke array dan ke UI
                        benefit_tags.push(tagText);

                        let tagContainer = $('#selected-tags-benefit');
                        tagContainer.append(`
                            <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                                ${tagText}
                                <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="$(this).parent().remove(); updateBenefitCounter();">×</span>
                            </div>
                        `);
                        tagContainer.append(`<input type="hidden" name="benefit_beasiswa[]" value="${tagText}">`);
                        updateBenefitCounter();
                        $('#benefit_beasiswa').val('');
                    }

                    function updateBenefitCounter() {
                        let count = $('#selected-tags-benefit input[type="hidden"]').length;
                        $('#tag-counter-benefit').text(`Jumlah benefit yang dipilih: ${count}`);
                    }
                </script>
                <br>
                <p class="@error('poster') border-red-500 @enderror block text-sm font-medium text-gray-700">Poster Beasiswa</p>
                    <div class="mb-4">
                        <label for="poster_beasiswa" class="cursor-pointer block w-full px-3 py-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <i class="fa-duotone fa-solid fa-paperclip"></i>
                            <span id="file-name" class="ml-2 text-gray-600">Pilih file</span>
                            <input type="file" id="poster_beasiswa" name="poster[]" class="hidden" accept="image/*" multiple onchange="displayFileNamesAndPreview()">
                        </label>
                        @error('poster')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div id="file-list" class="mt-2 text-gray-600"></div> <!-- Daftar nama file -->
                    <div id="preview-container" class="flex flex-wrap gap-4 mt-2"></div> <!-- Preview gambar -->

                    <!-- Modal untuk menampilkan gambar besar -->
                    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="relative max-w-full max-h-full">
                            <img id="modal-image" class="max-w-screen max-h-screen object-contain rounded-md shadow-lg">
                            <button id="close-modal" class="absolute top-2 right-2 bg-white text-black rounded-full p-1" onclick="event.preventDefault()">X</button>
                        </div>
                    </div>

                    <script>
                        document.getElementById('poster_beasiswa').addEventListener('change', function () {
                            if (this.files.length > 3) {
                                alert("Anda hanya dapat mengupload maksimal 3 file.");
                                this.value = ""; // Reset file input
                            }
                        });
                        let selectedFiles = []; // Menyimpan file yang dipilih

                        function displayFileNamesAndPreview() {
                            const input = document.getElementById('poster_beasiswa');
                            if (input.files.length > 3) {
                                alert("Anda hanya dapat mengupload maksimal 3 file.");
                                input.value = "";
                                return;
                            }
                            selectedFiles = Array.from(input.files); // Salin file yang dipilih ke array `selectedFiles`
                            renderPreviews();
                        }

                        function renderFileList() {
                            const fileList = document.getElementById('file-list');
                            fileList.innerHTML = ''; // Kosongkan daftar file

                            selectedFiles.forEach((file, index) => {
                                const fileItem = document.createElement('div');
                                fileItem.classList.add('flex', 'items-center', 'justify-between', 'mb-1');

                                const fileName = document.createElement('span');
                                fileName.textContent = file.name;

                                const deleteButton = document.createElement('button');
                                deleteButton.textContent = 'Hapus';
                                deleteButton.classList.add('text-red-500', 'ml-2', 'hover:underline');
                                deleteButton.onclick = () => removeFile(index); // Panggil fungsi `removeFile`

                                fileItem.appendChild(fileName);
                                fileItem.appendChild(deleteButton);
                                fileList.appendChild(fileItem);
                            });
                        }

                        function renderPreviews() {
                            const previewContainer = document.getElementById('preview-container');
                            previewContainer.innerHTML = ''; // Kosongkan kontainer preview

                            selectedFiles.forEach((file, index) => {
                                if (file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                        const imgContainer = document.createElement('div');
                                        imgContainer.classList.add('relative', 'w-24', 'h-24', 'mb-2', 'mr-2');

                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.alt = file.name;
                                        img.classList.add('w-full', 'h-full', 'object-cover', 'rounded-md', 'shadow-sm');

                                        // Fungsi untuk memperbesar gambar saat diklik
                                        img.onclick = () => openModal(e.target.result);

                                        const deleteButton = document.createElement('button');
                                        deleteButton.textContent = 'X';
                                        deleteButton.classList.add(
                                            'absolute', 'top-1', 'right-1', 'bg-red-500', 'text-white', 'rounded-full', 'w-6', 'h-6', 'flex',
                                            'items-center', 'justify-center', 'text-xs', 'opacity-0', 'hover:opacity-100', 'transition-opacity'
                                        );
                                        deleteButton.onclick = () => removeFile(index); // Panggil fungsi `removeFile`

                                        imgContainer.onmouseenter = () => (deleteButton.style.opacity = '1'); // Tampilkan tombol saat dihover
                                        imgContainer.onmouseleave = () => (deleteButton.style.opacity = '0'); // Sembunyikan tombol saat tidak dihover

                                        imgContainer.appendChild(img);
                                        imgContainer.appendChild(deleteButton);
                                        previewContainer.appendChild(imgContainer);
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });
                        }

                        function removeFile(index) {
                            selectedFiles.splice(index, 1); // Hapus file dari array `selectedFiles`
                            renderFileList(); // Perbarui daftar file
                            renderPreviews(); // Perbarui preview gambar
                        }

                        function openModal(imageSrc) {
                            const modal = document.getElementById('modal');
                            const modalImage = document.getElementById('modal-image');
                            modalImage.src = imageSrc; // Set gambar modal ke gambar yang diklik
                            modal.classList.remove('hidden'); // Tampilkan modal
                        }

                        document.getElementById('close-modal').onclick = function () {
                            event.preventDefault();
                            document.getElementById('modal').classList.add('hidden'); // Sembunyikan modal saat tombol close diklik
                        };

                        document.getElementById('modal').onclick = function (e) {
                            if (e.target === this) {
                                event.preventDefault();
                                this.classList.add('hidden'); // Sembunyikan modal saat area luar gambar diklik
                            }
                        };
                    </script>

                <div>
                    <button type="submit" style="background-color: #FF8E07" class="block w-full items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  hover:bg-[#D97600] ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@else
    <div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
        
        <div class="px4 py-6 sm:px-0">
            <div class="bg-white rounded-lg p-6">
            <form action="{{ route('beasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Nama Beasiswa -->
                        <div class="mb-4">
                            <label for="nama_beasiswa" class="block text-sm font-medium text-gray-700">Nama Beasiswa</label>
                            <input
                                type="text"
                                id="nama_beasiswa"
                                name="nama_beasiswa"
                                placeholder="Nama Beasiswa"
                                value="{{old('nama_beasiswa')}}"
                                class="block w-full border @error('nama_beasiswa') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                            >
                            @error('nama_beasiswa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Sumber Beasiswa -->
                        <div>
                            <label for="sumber_beasiswa" class="block text-sm font-medium text-gray-700">Sumber Beasiswa</label>
                            <input type="text" id="sumber_beasiswa" name="sumber_beasiswa" placeholder="Sumber Beasiswa" value="{{old('sumber_beasiswa')}}"
                                class="block w-full border @error('sumber_beasiswa') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                            @error('sumber_beasiswa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Beasiswa</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                                  class="mt-1 block w-full px-3 py-2 border @error('deskripsi') border-red-500 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                        <div>
                            <p class="block text-sm font-medium text-gray-700">Jenis Beasiswa</p>
                            @error('jenis_beasiswa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div class="mb-4">
                                    <label for="full" class="flex items-center space-x-3">
                                        <input type="radio" id="full" name="jenis_beasiswa" value="full"
                                            class="form-radio h-5 w-5 text-blue-500 rounded-full @error('jenis_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                            {{ old('jenis_beasiswa') == 'full' ? 'checked' : '' }}>
                                        <span class="text-gray-600">Full</span>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label for="half" class="flex items-center space-x-3">
                                        <input type="radio" id="half" name="jenis_beasiswa" value="setengah"
                                            class="form-radio h-5 w-5 text-blue-500 rounded-full @error('jenis_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                            {{ old('jenis_beasiswa') == 'setengah' ? 'checked' : '' }}>
                                        <span class="text-gray-600">Half</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    <p class="block text-sm font-medium text-gray-700">Tipe Beasiswa</p>
                    @error('tipe_beasiswa')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="mb-4">
                            <label for="internal" class="flex items-center space-x-3">
                                <input type="radio" id="internal" name="tipe_beasiswa" value="internal"
                                    class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                    {{ old('tipe_beasiswa') == 'internal' ? 'checked' : '' }}>
                                <span class="text-gray-600">Internal</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label for="kipk" class="flex items-center space-x-3">
                                <input type="radio" id="kipk" name="tipe_beasiswa" value="kipk"
                                    class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                    {{ old('tipe_beasiswa') == 'kipk' ? 'checked' : '' }}>
                                <span class="text-gray-600">KIPK</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label for="eksternal" class="flex items-center space-x-3">
                                <input type="radio" id="eksternal" name="tipe_beasiswa" value="eksternal"
                                    class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                    {{ old('tipe_beasiswa') == 'eksternal' ? 'checked' : '' }}>
                                <span class="text-gray-600">Eksternal</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Tanggal Mulai -->
                        <div>
                            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <div class="relative mt-1">
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                    class="block w-full border @error('tanggal_mulai')
                     border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                                     value="{{old('tanggal_mulai')}}">
                            </div>
                            @error('tanggal_mulai')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Berakhir -->
                        <div>
                            <label for="tanggal_berakhir" class="block text-sm font-medium text-gray-700">Tanggal Berakhir</label>
                            <div class="relative mt-1">
                                <input type="date" id="tanggal_berakhir" name="tanggal_berakhir"
                                class="block w-full border @error('tanggal_berakhir')
             border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                                value="{{old('tanggal_berakhir')}}">
                            </div>
                            @error('tanggal_berakhir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Kuota Beasiswa -->
                    <div>
                        <label for="kuota_beasiswa" class="block text-sm font-medium text-gray-700">Kuota Beasiswa</label>
                        <input type="number" id="kuota_beasiswa" name="kuota_beasiswa" value="{{old('kuota_beasiswa')}}" placeholder="Kuota Beasiswa"
                            class="block w-full border @error('kuota_beasiswa') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                    </div>
                    @error('kuota_beasiswa')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <br>
                    

                    <!-- Jenjang Pendidikan -->
                    <div class="relative">
                        <label for="jenjang_pendidikan" class="block text-sm font-medium text-gray-700">Jenjang Pendidikan</label>
                        <div id="selected-tags-jenjang" class="flex flex-wrap gap-2 mb-2"></div>
                        <input type="search" id="jenjang_pendidikan" name="input_jenjang_pendidikan" placeholder="Jenjang Pendidikan"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        oninput="fetchJenjangTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); }">
                        <div id="jenjang-suggestions" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto "></div>
                        <div id="tag-counter-jenjang" class="mb-2 text-sm text-gray-600">Jumlah jenjang yang dipilih: 0</div>
                    </div>

                    <!-- Syarat Beasiswa -->
                    <div class="relative">
                        <label for="syarat_beasiswa" class="block text-sm font-medium text-gray-700">Syarat-Syarat Beasiswa</label>
                        <div id="selected-tags-beasiswa" class="flex flex-wrap gap-2 mb-2"></div>
                        <input type="search" id="syarat_beasiswa" name="input_syarat_beasiswa" placeholder="Syarat-syarat Beasiswa"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        oninput="fetchBeasiswaTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); addBeasiswaTag(this.value); this.nextElementSibling.classList.add('hidden');}">
                        <div id="syarat-suggestions-beasiswa" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                        <div id="tag-counter-beasiswa" class="mb-2 text-sm text-gray-600">Jumlah syarat yang dipilih: 0</div>
                    </div>

                    <!-- Syarat Dokumen Beasiswa -->
                    <div class="relative">
                        <label for="syarat_dokumen" class="block text-sm font-medium text-gray-700">Syarat-Syarat Dokumen Beasiswa</label>
                        <div id="selected-tags-dokumen" class="flex flex-wrap gap-2 mb-2"></div>
                        <input type="search" id="syarat_dokumen" name="input_syarat_dokumen" placeholder="Syarat-syarat Dokumen"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        oninput="fetchDokumenTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); addDokumenTag(this.value); this.nextElementSibling.classList.add('hidden');}">
                        <div id="syarat-suggestions-dokumen" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                        <div id="tag-counter-dokumen" class="mb-2 text-sm text-gray-600">Jumlah syarat dokumen yang dipilih: 0</div>
                    </div>

                    <!-- Benefit Beasiswa -->
                    <div class="relative">
                        <label for="benefit_beasiswa" class="block text-sm font-medium text-gray-700">Benefit Beasiswa</label>
                        <div id="selected-tags-benefit" class="flex flex-wrap gap-2 mb-2"></div>
                        <input type="search" id="benefit_beasiswa" name="input_benefit_beasiswa" placeholder="Benefit Beasiswa"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        oninput="fetchBenefitTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); addBenefitTag(this.value); this.nextElementSibling.classList.add('hidden');}">
                        <div id="benefit-suggestions-beasiswa" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                        <div id="tag-counter-benefit" class="mb-2 text-sm text-gray-600">Jumlah benefit yang dipilih: 0</div>
                    </div>

                    <script>
                        let jenjang_tags = [];
                        let syarat_tags = [];
                        let benefit_tags = [];
                        let dokumen_tags = [];
                        // Fetch tags for jenjang pendidikan
                        function fetchJenjangTags() {
                            let query = $('#jenjang_pendidikan').val().trim();
                            if (query === '') {
                                $('#jenjang-suggestions').addClass('hidden');
                                return;
                            }
                            $.ajax({
                                url: "{{ route('Beasiswa.search_jenjang') }}",
                                type: 'GET',
                                data: { query: query },
                                success: function(tags) {
                                    let suggestions = $('#jenjang-suggestions').empty().removeClass('hidden');
                                    if (!tags.length) {
                                        suggestions.addClass('hidden');
                                        return;
                                    }
                                    tags.forEach(tag => {
                                        suggestions.append(`
                                            <div class="tag-suggestion-jenjang px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                                                ${tag.nama_prodi}
                                            </div>
                                        `);
                                    });
                                    $('.tag-suggestion-jenjang').on('click', function() {
                                        addJenjangTag($(this).text());
                                        suggestions.empty().addClass('hidden');
                                    });
                                }
                            });
                        }

                        // Add tag for jenjang pendidikan
                        function addJenjangTag(tagText) {
                            tagText = tagText.trim();

                            if (jenjang_tags.includes(tagText)) {
                                $('#jenjang_pendidikan').val('');
                                return;
                            }

                            if (tagText === ''){
                                return;
                            }

                            // Tambahkan tag ke array dan ke UI
                            jenjang_tags.push(tagText);

                            let tagContainer = $('#selected-tags-jenjang');
                            tagContainer.append(`
                                <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                                    ${tagText}
                                    <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, 'jenjang_tags');">×</span>
                                    <input type="hidden" name="jenjang_pendidikan[]" value="${tagText}">
                                </div>
                            `);
                            updateJenjangCounter();
                            $('#jenjang_pendidikan').val('');
                        }

                        function updateJenjangCounter() {
                            let count = $('#selected-tags-jenjang input[type="hidden"]').length;
                            $('#tag-counter-jenjang').text(`Jumlah jenjang yang dipilih: ${count}`);
                        }
                        
                        // Fetch tags for beasiswa
                        function fetchBeasiswaTags() {
                            let query = $('#syarat_beasiswa').val().trim();
                            if (query === '') {
                                $('#syarat-suggestions-beasiswa').addClass('hidden');
                                return;
                            }
                            $.ajax({
                                url: "{{ route('Beasiswa.search_syarat') }}",
                                type: 'GET',
                                data: { query: query },
                                success: function(tags) {
                                    let suggestions = $('#syarat-suggestions-beasiswa').empty().removeClass('hidden');
                                    if (!tags.length) {
                                        suggestions.addClass('hidden');
                                        return;
                                    }
                                    tags.forEach(tag => {
                                        suggestions.append(`
                                            <div class="tag-suggestion-syarat px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                                                ${tag.syarat}
                                            </div>
                                        `);
                                    });
                                    $('.tag-suggestion-syarat').on('click', function() {
                                        addBeasiswaTag($(this).text());
                                        suggestions.empty().addClass('hidden');
                                    });
                                }
                            });
                        }

                        // Add tag for beasiswa
                        function addBeasiswaTag(tagText) {
                            tagText = tagText.trim();
                            if (syarat_tags.includes(tagText)) {
                                $('#syarat_beasiswa').val('');
                                return;
                            }

                            if (tagText === ''){
                                return;
                            }
                            // Tambahkan tag ke array dan ke UI
                            syarat_tags.push(tagText);

                            let tagContainer = $('#selected-tags-beasiswa');
                            tagContainer.append(`
                                <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                                    ${tagText}
                                    <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, 'syarat_tags');">×</span>
                                    <input type="hidden" name="syarat_beasiswa[]" value="${tagText}">
                                </div>
                            `);
                            updateBeasiswaCounter();
                            $('#syarat_beasiswa').val('');
                        }

                        function updateBeasiswaCounter() {
                            let count = $('#selected-tags-beasiswa input[type="hidden"]').length;
                            $('#tag-counter-beasiswa').text(`Jumlah syarat yang dipilih: ${count}`);
                        }

                        // Similar functions for dokumen
                        function fetchDokumenTags() {
                            let query = $('#syarat_dokumen').val().trim();
                            if (query === '') {
                                $('#syarat-suggestions-dokumen').addClass('hidden');
                                return;
                            }
                            $.ajax({
                                url: "{{ route('Beasiswa.search_dokumen') }}",
                                type: 'GET',
                                data: { query: query },
                                success: function(tags) {
                                    let suggestions = $('#syarat-suggestions-dokumen').empty().removeClass('hidden');
                                    if (!tags.length) {
                                        suggestions.addClass('hidden');
                                        return;
                                    }
                                    tags.forEach(tag => {
                                        suggestions.append(`
                                            <div class="tag-suggestion-dokumen px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                                                ${tag.dokumen}
                                            </div>
                                        `);
                                    });
                                    $('.tag-suggestion-dokumen').on('click', function() {
                                        addDokumenTag($(this).text());
                                        suggestions.empty().addClass('hidden');
                                    });
                                }
                            });
                        }

                        function addDokumenTag(tagText) {
                            tagText = tagText.trim();

                            if (dokumen_tags.includes(tagText)) {
                                $('#syarat_dokumen').val('');
                                return;
                            }
                            if (tagText === ''){
                                return;
                            }

                            // Tambahkan tag ke array dan ke UI
                            dokumen_tags.push(tagText);

                            let tagContainer = $('#selected-tags-dokumen');
                            tagContainer.append(`
                                <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                                    ${tagText}
                                    <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, 'dokumen_tags');">×</span>
                                    <input type="hidden" name="syarat_dokumen[]" value="${tagText}">
                                </div>
                            `);
                            updateDokumenCounter();
                            $('#syarat_dokumen').val('');
                        }

                        function updateDokumenCounter() {
                            let count = $('#selected-tags-dokumen input[type="hidden"]').length;
                            $('#tag-counter-dokumen').text(`Jumlah syarat dokumen yang dipilih: ${count}`);
                        }

                        // Fetch tags for benefit
                        function fetchBenefitTags() {
                            let query = $('#benefit_beasiswa').val().trim();
                            if (query === '') {
                                $('#benefit-suggestions-beasiswa').addClass('hidden');
                                return;
                            }
                            $.ajax({
                                url: "{{ route('Beasiswa.search_benefit') }}",
                                type: 'GET',
                                data: { query: query },
                                success: function(tags) {
                                    let suggestions = $('#benefit-suggestions-beasiswa').empty().removeClass('hidden');
                                    if (!tags.length) {
                                        suggestions.addClass('hidden');
                                        return;
                                    }
                                    tags.forEach(tag => {
                                        suggestions.append(`
                                            <div class="tag-suggestion-benefit px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                                                ${tag.benefit}
                                            </div>
                                        `);
                                    });
                                    $('.tag-suggestion-benefit').on('click', function() {
                                        addBenefitTag($(this).text());
                                        suggestions.empty().addClass('hidden');
                                    });
                                }
                            });
                        }

                        // Add tag for benefit
                        function addBenefitTag(tagText) {
                            tagText = tagText.trim();

                            if (benefit_tags.includes(tagText)) {
                                $('#benefit_beasiswa').val('');
                                return;
                            }

                            
                            // Tambahkan tag ke array dan ke UI
                            benefit_tags.push(tagText);

                            let tagContainer = $('#selected-tags-benefit');
                            tagContainer.append(`
                                <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                                    ${tagText}
                                    <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, 'benefit_tags');">×</span>
                                    <input type="hidden" name="benefit_beasiswa[]" value="${tagText}">
                                </div>
                            `);
                            updateBenefitCounter();
                            $('#benefit_beasiswa').val('');
                        } 

                        function updateBenefitCounter() {
                            let count = $('#selected-tags-benefit input[type="hidden"]').length;
                            $('#tag-counter-benefit').text(`Jumlah benefit yang dipilih: ${count}`);
                        }

                        function removeTag(tagText, element, arrayName) {
                            tagText = tagText.trim();

                            // Hapus tag dari UI
                            $(element).parent().remove();

                            if (arrayName == 'benefit_tags'){
                                benefit_tags = benefit_tags.filter(tag => tag !== tagText);
                                updateBenefitCounter();
                            } else if (arrayName == 'jenjang_tags'){
                                jenjang_tags = jenjang_tags.filter(tag => tag !== tagText);
                                updateJenjangCounter();
                            } else if (arrayName == 'syarat_tags'){
                                syarat_tags = syarat_tags.filter(tag => tag !== tagText);
                                updateBeasiswaCounter();
                            } else {
                                dokumen_tags = dokumen_tags.filter(tag => tag !== tagText);
                                updateDokumenCounter();
                            }
                        }
                    </script>

                    <br>
                    <p class="@error('poster') border-red-500 @enderror block text-sm font-medium text-gray-700">Poster Beasiswa</p>
                    <div class="mb-4">
                        <label for="poster_beasiswa" class="cursor-pointer block w-full px-3 py-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <i class="fa-duotone fa-solid fa-paperclip"></i>
                            <span id="file-name" class="ml-2 text-gray-600">Pilih file</span>
                            <input type="file" id="poster_beasiswa" name="poster[]" class="hidden" accept="image/*" multiple onchange="displayFileNamesAndPreview()">
                        </label>
                        @error('poster')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div id="file-list" class="mt-2 text-gray-600"></div> <!-- Daftar nama file -->
                    <div id="preview-container" class="flex flex-wrap gap-4 mt-2"></div> <!-- Preview gambar -->

                    <!-- Modal untuk menampilkan gambar besar -->
                    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="relative max-w-full max-h-full">
                            <img id="modal-image" class="max-w-screen max-h-screen object-contain rounded-md shadow-lg">
                            <button id="close-modal" class="absolute top-2 right-2 bg-white text-black rounded-full p-1" onclick="event.preventDefault()">X</button>
                        </div>
                    </div>

                    <script>
                        document.getElementById('poster_beasiswa').addEventListener('change', function () {
                            if (this.files.length > 3) {
                                alert("Anda hanya dapat mengupload maksimal 3 file.");
                                this.value = ""; // Reset file input
                            }
                        });
                        let selectedFiles = []; // Menyimpan file yang dipilih

                        function displayFileNamesAndPreview() {
                            const input = document.getElementById('poster_beasiswa');
                            if (input.files.length > 3) {
                                alert("Anda hanya dapat mengupload maksimal 3 file.");
                                input.value = "";
                                return;
                            }
                            selectedFiles = Array.from(input.files); // Salin file yang dipilih ke array `selectedFiles`
                            renderPreviews();
                        }

                        function renderFileList() {
                            const fileList = document.getElementById('file-list');
                            fileList.innerHTML = ''; // Kosongkan daftar file

                            selectedFiles.forEach((file, index) => {
                                const fileItem = document.createElement('div');
                                fileItem.classList.add('flex', 'items-center', 'justify-between', 'mb-1');

                                const fileName = document.createElement('span');
                                fileName.textContent = file.name;

                                const deleteButton = document.createElement('button');
                                deleteButton.textContent = 'Hapus';
                                deleteButton.classList.add('text-red-500', 'ml-2', 'hover:underline');
                                deleteButton.onclick = () => removeFile(index); // Panggil fungsi `removeFile`

                                fileItem.appendChild(fileName);
                                fileItem.appendChild(deleteButton);
                                fileList.appendChild(fileItem);
                            });
                        }

                        function renderPreviews() {
                            const previewContainer = document.getElementById('preview-container');
                            previewContainer.innerHTML = ''; // Kosongkan kontainer preview

                            selectedFiles.forEach((file, index) => {
                                if (file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                        const imgContainer = document.createElement('div');
                                        imgContainer.classList.add('relative', 'w-24', 'h-24', 'mb-2', 'mr-2');

                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.alt = file.name;
                                        img.classList.add('w-full', 'h-full', 'object-cover', 'rounded-md', 'shadow-sm');

                                        // Fungsi untuk memperbesar gambar saat diklik
                                        img.onclick = () => openModal(e.target.result);

                                        const deleteButton = document.createElement('button');
                                        deleteButton.textContent = 'X';
                                        deleteButton.classList.add(
                                            'absolute', 'top-1', 'right-1', 'bg-red-500', 'text-white', 'rounded-full', 'w-6', 'h-6', 'flex',
                                            'items-center', 'justify-center', 'text-xs', 'opacity-0', 'hover:opacity-100', 'transition-opacity'
                                        );
                                        deleteButton.onclick = () => removeFile(index); // Panggil fungsi `removeFile`

                                        imgContainer.onmouseenter = () => (deleteButton.style.opacity = '1'); // Tampilkan tombol saat dihover
                                        imgContainer.onmouseleave = () => (deleteButton.style.opacity = '0'); // Sembunyikan tombol saat tidak dihover

                                        imgContainer.appendChild(img);
                                        imgContainer.appendChild(deleteButton);
                                        previewContainer.appendChild(imgContainer);
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });
                        }

                        function removeFile(index) {
                            selectedFiles.splice(index, 1); // Hapus file dari array `selectedFiles`
                            renderFileList(); // Perbarui daftar file
                            renderPreviews(); // Perbarui preview gambar
                        }

                        function openModal(imageSrc) {
                            const modal = document.getElementById('modal');
                            const modalImage = document.getElementById('modal-image');
                            modalImage.src = imageSrc; // Set gambar modal ke gambar yang diklik
                            modal.classList.remove('hidden'); // Tampilkan modal
                        }

                        document.getElementById('close-modal').onclick = function () {
                            event.preventDefault();
                            document.getElementById('modal').classList.add('hidden'); // Sembunyikan modal saat tombol close diklik
                        };

                        document.getElementById('modal').onclick = function (e) {
                            if (e.target === this) {
                                event.preventDefault();
                                this.classList.add('hidden'); // Sembunyikan modal saat area luar gambar diklik
                            }
                        };

                        $('form').on('submit', function(e) {
                            let hiddenInputs = $('input[type="hidden"]');
                            hiddenInputs.each(function() {
                                console.log($(this).val()); // Check if hidden inputs have values
                            });
                        });

                    </script>

                    <div>
                        <button type="submit" style="background-color: #FF8E07" class="block w-full items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  hover:bg-[#D97600] ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif
