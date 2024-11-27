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
                        <div>
                            <p class="block text-sm font-medium text-gray-700">Jenjang Pendidikan</p>
                            <div class="mb-4">
                                <label for="D3" class="flex items-center space-x-3">
                                    <input type="checkbox" id="D3" name="jenjang_pendidikan[]" value="D3" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                    @checked(in_array("D3", old('jenjang_pendidikan', $jenjang)))>
                                    <span class="text-gray-600">D3</span>
                                </label>
                            </div>
                            <div class="mb-4">
                                <label for="D4" class="flex items-center space-x-3">
                                    <input type="checkbox" id="D4" name="jenjang_pendidikan[]" value="D4" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                    @checked(in_array("D4",old('jenjang_pendidikan', $jenjang)))>
                                    <span class="text-gray-600">D4</span>
                                </label>
                            </div>
                        </div>
                        <div>
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
                        <label for="prestasi" class="flex items-center space-x-3">
                            <input type="radio" id="prestasi" name="tipe_beasiswa" value="prestasi" class="form-radio h-5 w-5 text-blue-500 rounded-full focus:ring-blue-500"
                            @checked(old('tipe_beasiswa', $beasiswa->tipe_beasiswa) == "prestasi")>
                            <span class="text-gray-600">Prestasi</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label for="ekonomi" class="flex items-center space-x-3">
                            <input type="radio" id="ekonomi" name="tipe_beasiswa" value="ekonomi" class="form-radio h-5 w-5 text-blue-500 rounded-full focus:ring-blue-500"
                            @checked(old('tipe_beasiswa', $beasiswa->tipe_beasiswa) == "ekonomi")>
                            <span class="text-gray-600">Ekonomi</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label for="eksternal" class="flex items-center space-x-3">
                            <input type="radio" id="eksternal" name="tipe_beasiswa" value="external" class="form-radio h-5 w-5 text-blue-500 rounded-full focus:ring-blue-500"
                            @checked(old('tipe_beasiswa', $beasiswa->tipe_beasiswa) == "external")>
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

                <h2 class="text-lg font-bold mb-4 block">Syarat-Syarat Beasiswa</h2>
                <div class="grid grid-cols-2 gap-10">
                    <!-- Syarat-Syarat Beasiswa -->
                    <div>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox"
                                       class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                       onclick="toggleIpkMin()"
                                       id="ipk_checkbox"
                                       @checked(collect(old('ipk_min', $syarat))->contains(fn($s) => is_numeric($s)))>
                                <label>IPK</label>
                                <input type="text" id="IPK_min" name="ipk_min"
                                       class="ml-2 w-16 border rounded p-1 text-center"
                                       value="{{ collect(old('ipk_min', $syarat))->first(fn($s) => is_numeric($s)) }}"
                                       disabled>
                                @error('ipk_min')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <script>
                                function toggleIpkMin() {
                                    // Dapatkan elemen checkbox dan input IPK_min
                                    const checkbox = document.getElementById('ipk_checkbox');
                                    const ipkMinInput = document.getElementById('IPK_min');

                                    // Aktifkan input IPK_min hanya jika checkbox dicentang
                                    ipkMinInput.disabled = !checkbox.checked;
                                }
                            </script>


                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="transkrip_nilai" name="syarat_beasiswa[]" value="Transkrip Nilai" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Transkrip Nilai", old('syarat_beasiswa', $syarat)))>
                                <label>Transkrip Nilai</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="proposal" name="syarat_beasiswa[]" value="Proposal" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Proposal", old('syarat_beasiswa', $syarat)))>
                                <label>Proposal</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="esai" name="syarat_beasiswa[]" value="Esai" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Esai", old('syarat_beasiswa', $syarat)))>
                                <label>Esai</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="sertifikat_prestasi" name="syarat_beasiswa[]" value="Sertifikat Prestasi" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Sertifikat Prestasi", old('syarat_beasiswa', $syarat)))>
                                <label>Sertifikat Prestasi</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="suket_penghasilan" name="syarat_beasiswa[]" value="Surat Keterangan Penghasilan Orangtua" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Surat Keterangan Penghasilan Orangtua", old('syarat_beasiswa', $syarat)))>
                                <label>Surat Keterangan Penghasilan Orangtua</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="suket_tidakmampu" name="syarat_beasiswa[]" value="Surat Keterangan Tidak Mampu" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Surat Keterangan Tidak Mampu", old('syarat_beasiswa', $syarat)))>
                                <label>Surat Keterangan Tidak Mampu</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="suket_rekomendasi" name="syarat_beasiswa[]" value="Surat Rekomendasi" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Surat Rekomendasi", old('syarat_beasiswa', $syarat)))>
                                <label>Surat Rekomendasi</label>
                            </div>
                        </div>
                    </div>

                    <!-- Benefit Beasiswa -->
                    <div>
                        <h2 class="text-lg font-bold mb-4">Benefit Beasiswa</h2>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Biaya Kuliah Penuh" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Biaya Kuliah Penuh", old('benefit_beasiswa', $benefit)))>
                                <label>Biaya Kuliah Penuh</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Tunjangan Biaya Hidup" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Tunjangan Biaya Hidup", old('benefit_beasiswa', $benefit)))>
                                <label>Tunjangan Biaya Hidup</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Buku dan Perlengkapan Akademik" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Buku dan Perlengkapan Akademik", old('benefit_beasiswa', $benefit)))>
                                <label>Buku dan Perlengkapan Akademik</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Internship" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"
                                @checked(in_array("Internship", old('benefit_beasiswa', $benefit)))>
                                <label>Internship</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <p class="@error('poster[]') border-red-500 @enderror block text-sm font-medium text-gray-700">Poster Beasiswa</p>
                @error('poster[]')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                        <div class="mb-4">
                        <label for="poster_beasiswa" class="cursor-pointer block w-full px-3 py-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <i class="fa-duotone fa-solid fa-paperclip"></i>
                            <span id="file-name" class="ml-2 text-gray-600">Pilih file</span>
                            <input type="file" id="poster_beasiswa" name="poster[]" class="hidden" accept="image/*" multiple onchange="displayFileNamesAndPreview()">
                        </label>
                        
                    </div>
                    <div id="preview-container" class="flex flex-wrap gap-4 mt-2">
                        @if(isset($poster) && count($poster) > 0)
                            @foreach($poster as $index => $link)
                                <div class="relative w-24 h-24 mb-2 mr-2" id="poster-{{$index}}">
                                    <img src="{{ $link }}" alt="Poster" class="w-full h-full object-cover rounded-md shadow-sm" onclick="openModal('{{ $link }}')">
                                    <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 hover:opacity-100 transition-opacity" onclick="removePoster('{{$index}}')">X</button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Modal untuk menampilkan gambar besar -->
                    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="relative max-w-full max-h-full">
                            <img id="modal-image" class="max-w-screen max-h-screen object-contain rounded-md shadow-lg">
                            <button id="close-modal" class="absolute top-2 right-2 bg-white text-black rounded-full p-1">X</button>
                        </div>
                    </div>

                    <script>
                        function removePoster(posterid){
                            document.getElementById(`poster-${posterid}`).remove();
                        }

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
                            renderPreviews(); // Perbarui preview gambar
                        }

                        function openModal(imageSrc) {
                            const modal = document.getElementById('modal');
                            const modalImage = document.getElementById('modal-image');
                            modalImage.src = imageSrc; // Set gambar modal ke gambar yang diklik
                            modal.classList.remove('hidden'); // Tampilkan modal
                        }

                        document.getElementById('close-modal').onclick = function () {
                            document.getElementById('modal').classList.add('hidden'); // Sembunyikan modal saat tombol close diklik
                        };

                        document.getElementById('modal').onclick = function (e) {
                            if (e.target === this) {
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
        <div class="px-4 py-6 sm:px-0">
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


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="block text-sm font-medium text-gray-700">Jenjang Pendidikan</p>
                            <div class="mb-4">
                                <label for="D3" class="flex items-center space-x-3">
                                    <input type="checkbox" id="D3" name="jenjang_pendidikan[]" value="D3" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('jenjang_pendidikan')) && in_array('D3', old('jenjang_pendidikan'))) checked @endif>
                                    <span class="text-gray-600">D3</span>
                                </label>
                            </div>
                            <div class="mb-4">
                                <label for="D4" class="flex items-center space-x-3">
                                    <input type="checkbox" id="D4" name="jenjang_pendidikan[]" value="D4" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('jenjang_pendidikan')) && in_array('D4', old('jenjang_pendidikan'))) checked @endif>
                                    <span class="text-gray-600">D4</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <p class="block text-sm font-medium text-gray-700">Jenis Beasiswa</p>
                            @error('jenis_beasiswa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                            <label for="prestasi" class="flex items-center space-x-3">
                                <input type="radio" id="prestasi" name="tipe_beasiswa" value="prestasi"
                                    class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                    {{ old('tipe_beasiswa') == 'prestasi' ? 'checked' : '' }}>
                                <span class="text-gray-600">Prestasi</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label for="ekonomi" class="flex items-center space-x-3">
                                <input type="radio" id="ekonomi" name="tipe_beasiswa" value="ekonomi"
                                    class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                    {{ old('tipe_beasiswa') == 'ekonomi' ? 'checked' : '' }}>
                                <span class="text-gray-600">Ekonomi</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label for="eksternal" class="flex items-center space-x-3">
                                <input type="radio" id="eksternal" name="tipe_beasiswa" value="external"
                                    class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                    {{ old('tipe_beasiswa') == 'external' ? 'checked' : '' }}>
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

                    <!-- Container untuk tag yang dipilih -->
                    <div id="selected-tags" class="flex flex-wrap gap-2 mb-2"></div>

                    <!-- Counter untuk jumlah tag yang dipilih -->
                    <div id="tag-counter" class="mb-2 text-sm text-gray-600">Jumlah syarat yang dipilih: 0</div>

                    <!-- Input pencarian -->
                    <div class="relative">
                        <label for="syarat_beasiswa" class="block text-sm font-medium text-gray-700">Syarat-Syarat Beasiswa</label>
                        <input type="search" id="syarat_beasiswa" name="syarat_beasis" placeholder="Syarat-syarat Beasiswa"
                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                            oninput="fetchTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) {let inputText = $('#syarat_beasiswa').val().trim();
                                    if (inputText !== '') {
                                        addTag(inputText);  // Tambahkan input pengguna sebagai tag
                                    } event.preventDefault()}">
                        <div id="syarat-suggestions" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden"></div>
                    </div>

                    <script>   
                        function fetchTags() {
                            let query = $('#syarat_beasiswa').val();
                            
                            if (query.trim() === '') {
                                $('#syarat-suggestions').addClass('hidden'); // Hide suggestions when input is empty
                                return;
                            }
                    
                            $.ajax({
                                url: "{{ route('Beasiswa.search_syarat') }}",
                                type: 'GET',
                                data: { query: query },
                                success: function(tags) {
                                    $('#syarat-suggestions').empty().removeClass('hidden'); // Show the suggestions
                                    
                                    if (tags.length === 0) {
                                        // Jika tidak ada saran, tampilkan pesan kosong atau teruskan tanpa hasil
                                        $('#syarat-suggestions').addClass('hidden');
                                        return;
                                    }
                    
                                    tags.forEach(tag => {
                                        $('#syarat-suggestions').append(`
                                            <div class="tag-suggestion px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                                                ${tag.syarat}
                                            </div>
                                        `);
                                    });
                    
                                    // Tambahkan event klik pada setiap tag rekomendasi
                                    $('.tag-suggestion').on('click', function() {
                                        addTag($(this).text());
                                        $('#syarat-suggestions').empty().addClass('hidden');
                                    });
                                }
                            });
                        }
                    
                        function addTag(tagText) {
                            // Tambahkan tag ke dalam container
                            $('#selected-tags').append(`
                                <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                                    ${tagText}
                                    <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag(this)">×</span>
                                </div>
                            `);
                    
                            // Tambahkan input tersembunyi untuk setiap tag yang dipilih
                            $('#selected-tags').append(`
                                <input type="hidden" name="syarat_beasiswa[]" value="${tagText}">
                            `);
                    
                            // Perbarui penghitung tag
                            updateTagCounter();
                    
                            // Bersihkan input setelah menambah tag
                            $('#syarat_beasiswa').val('');
                            $('#syarat-suggestions').addClass('hidden'); // Hide suggestions after tag is added
                        }
                    
                        function removeTag(element) {
                            // Hapus tag dari container
                            $(element).parent().remove();
                            
                            // Hapus input tersembunyi yang terkait dengan tag tersebut
                            $(element).parent().next('input[type="hidden"]').remove();
                            
                            // Perbarui penghitung tag
                            updateTagCounter();
                        }
                    
                        function updateTagCounter() {
                            // Hitung jumlah tag yang dipilih
                            let tagCount = $('#selected-tags input[type="hidden"]').length;
                            
                            // Perbarui teks penghitung tag
                            $('#tag-counter').text(`Jumlah syarat yang dipilih: ${tagCount}`);
                        }
                    </script>
                   

                    <div class="grid grid-cols-2 gap-10">
                        

                        <!-- Benefit Beasiswa -->
                        <div>
                            <h2 class="text-lg font-bold mb-4">Benefit Beasiswa</h2>
                            <div class="space-y-2">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="benefit_beasiswa[]" value="Biaya Kuliah Penuh" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('benefit_beasiswa')) && in_array('Biaya Kuliah Penuh', old('benefit_beasiswa'))) checked @endif>
                                    <label>Biaya Kuliah Penuh</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="benefit_beasiswa[]" value="Tunjangan Biaya Hidup" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('benefit_beasiswa')) && in_array('Tunjangan Biaya Hidup', old('benefit_beasiswa'))) checked @endif>
                                    <label>Tunjangan Biaya Hidup</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="benefit_beasiswa[]" value="Buku dan Perlengkapan Akademik" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('benefit_beasiswa')) && in_array('Buku dan Perlengkapan Akademik', old('benefit_beasiswa'))) checked @endif>
                                    <label>Buku dan Perlengkapan Akademik</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="benefit_beasiswa[]" value="Internship" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('benefit_beasiswa')) && in_array('Internship', old('benefit_beasiswa'))) checked @endif>
                                    <label>Internship</label>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <button id="close-modal" class="absolute top-2 right-2 bg-white text-black rounded-full p-1">X</button>
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
                            document.getElementById('modal').classList.add('hidden'); // Sembunyikan modal saat tombol close diklik
                        };

                        document.getElementById('modal').onclick = function (e) {
                            if (e.target === this) {
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

@endif
