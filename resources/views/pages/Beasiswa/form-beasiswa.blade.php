@extends('layouts.main2')
@section('content')
    @include('component.navbar',['path'=>"Tambah Beasiswa",'id'=>null, 'notificationData'=>$notificationData])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if ($beasiswa != null)
    <div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white rounded-lg p-6">
                <form id="beasiswa-form" action="{{ url("beasiswa/$beasiswa->id") }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Nama Beasiswa -->
                        <div class="mb-4">
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

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Beasiswa</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full px-3 py-2 border @error('deskripsi') border-red-500 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo old('deskripsi', $beasiswa->deskripsi)?></textarea>
                        @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Beasiswa -->
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
                                        {{ old('jenis_beasiswa', $beasiswa->jenis_beasiswa) == 'full' ? 'checked' : '' }}>
                                    <span class="text-gray-600">Full</span>
                                </label>
                            </div>
                            <div class="mb-4">
                                <label for="half" class="flex items-center space-x-3">
                                    <input type="radio" id="half" name="jenis_beasiswa" value="half"
                                        class="form-radio h-5 w-5 text-blue-500 rounded-full @error('jenis_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                        {{ old('jenis_beasiswa', $beasiswa->jenis_beasiswa) == 'half' ? 'checked' : '' }}>
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
                                    {{ old('tipe_beasiswa', $beasiswa->tipe_beasiswa) == 'internal' ? 'checked' : '' }}>
                                <span class="text-gray-600">Internal</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label for="kipk" class="flex items-center space-x-3">
                                <input type="radio" id="kipk" name="tipe_beasiswa" value="kipk"
                                    class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                    {{ old('tipe_beasiswa', $beasiswa->tipe_beasiswa) == 'kipk' ? 'checked' : '' }}>
                                <span class="text-gray-600">KIPK</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label for="eksternal" class="flex items-center space-x-3">
                                <input type="radio" id="eksternal" name="tipe_beasiswa" value="eksternal"
                                    class="form-radio h-5 w-5 text-blue-500 rounded-full @error('tipe_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                    {{ old('tipe_beasiswa', $beasiswa->tipe_beasiswa) == 'eksternal' ? 'checked' : '' }}>
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
                        <input type="search" id="jenjang_pendidikan" name="input_jenjang_pendidikan" placeholder="Jenjang Pendidikan"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        oninput="fetchJenjangTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); }">
                        <div id="jenjang-suggestions" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto "></div>
                        <div id="tag-counter-jenjang" class="mb-2 text-sm text-gray-600">Jumlah jenjang yang dipilih: 0</div>
                    </div>

                    <!-- Syarat Beasiswa -->
                    <div class="relative">
                        <label for="syarat_beasiswa" class="block text-sm font-medium text-gray-700">Syarat-Syarat Beasiswa</label>
                        <div id="selected-tags-syarat" class="flex flex-wrap gap-2 mb-2"></div>
                        <input type="search" id="syarat_beasiswa" name="input_syarat_beasiswa" placeholder="Syarat-syarat Beasiswa"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        oninput="fetchBeasiswaTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); addBeasiswaTag(this.value); this.nextElementSibling.classList.add('hidden');}">
                        <div id="syarat-suggestions-beasiswa" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                        <div id="tag-counter-beasiswa" class="mb-2 text-sm text-gray-600">Jumlah syarat yang dipilih: 0</div>
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

                    <!-- Syarat Dokumen Beasiswa -->
                    <div id="form-container">
                        <div class="grid grid-cols-12 gap-4 items-center" id="form-row-1">
                            <!-- Input Syarat Dokumen -->
                            <div class="col-span-6 relative">
                                <label for="dokumen-1" class="block text-sm font-medium text-gray-700 mb-1">Syarat Dokumen</label>
                                <input
                                    type="text"
                                    id="dokumen-1"
                                    name="nama_dokumen[]" 
                                    placeholder="Masukkan dokumen"
                                    class="syarat_dokumen col-span-2 w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    oninput="fetchDokumenTags(1)"
                                    onkeydown="handleDokumenKeydown(event, 1)"
                                />
                                <div id="syarat-suggestions-dokumen-1" 
                                     class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                            </div>
                    
                            <!-- Input Unggah Format Dokumen -->
                            <div class="col-span-5">
                                <label for="unggah-1" class="block text-sm font-medium text-gray-700 mb-1">Unggah Format Dokumen</label>
                                <input
                                    type="file"
                                    id="unggah-1"
                                    class="w-1/3 text-gray-500 file:mr-6 file:py-2 file:px-4 file:border-0 file:bg-orange-400 hover:file:bg-blue-100"
                                    name="dokumen_file[]"
                                    onchange="addDokumenFile(this.files[0], 1)"
                                />
                                <span id="dokumen-name-1" class="w-2/3 text-gray-500 ml-[-15px] bg-white">Belum ada file yang dipilih</span>
                            </div>
                    
                            <div class="col-span-1 justify-center flex items-center mt-7">
                                <div class="bg-red-400 hover:bg-red-600 rounded">
                                    <button
                                        type="button"
                                        class="px-3 text-sm font-medium"
                                        onclick="removeFormRow(1)"
                                    >
                                        X
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tombol Tambah Syarat Dokumen -->
                    <div class="mt-4">
                        <button
                            type="button"
                            id="add-button"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium"
                            onclick="createFormRow()"
                            >
                            <span class="text-xl mr-1">+</span> Tambahkan Syarat Dokumen
                        </button>
                    </div>

                    <br>
                    <p class="@error('poster') border-red-500 @enderror block text-sm font-medium text-gray-700">Poster Beasiswa</p>
                        <div class="mb-4">
                            <label for="poster_beasiswa" class="cursor-pointer block w-full px-3 py-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <i class="fa-duotone fa-solid fa-paperclip"></i>
                                <span id="file-name" class="ml-2 text-gray-600">Pilih file</span>
                                <input type="file" id="poster_beasiswa" name="input_poster[]" class="hidden" accept="image/*" multiple onchange="displayFileNamesAndPreview()">
                            </label>
                            @error('poster')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button onclick="event.preventDefault(); removeAllFiles();" class="text-red-500 ml-2 hover:underline">Hapus Semua</button>
                        <div id="preview-container" class="flex flex-wrap gap-4 mt-2"></div> <!-- Preview gambar -->
                        
                        <div id="hidden-input-container"></div>

                        <!-- Modal untuk menampilkan gambar besar -->
                        <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                            <div class="relative max-w-full max-h-full">
                                <img id="modal-image" class="max-w-screen max-h-screen object-contain rounded-md shadow-lg">
                                <button id="close-modal" class="absolute top-2 right-2 bg-white text-black rounded-full p-1" onclick="event.preventDefault()">X</button>
                            </div>
                        </div>
                    <div>
                        <button type="submit" style="background-color: #FF8E07" class="block w-full items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  hover:bg-[#D97600] ">Submit</button>
                        {{-- <button type="button" onclick="createHiddenInput()" style="background-color: #FF8E07" class="block w-full items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  hover:bg-[#D97600] ">Buttton</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

@else
    <div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px4 py-6 sm:px-0">
            <div class="bg-white rounded-lg p-6">
                <p>Gunakan Data Beasiswa yang sudah dibuat?</p>
                <div class="bg-[#FF8E07] rounded cursor-pointer p-1 mb-2 hover:cursor-pointer flex items-center" onclick="showPopup()">
                    <span class="text-xl mx-2">+</span> Template Data Beasiswa
                </div>
                

                <form id="beasiswa-form" action="{{ route('beasiswa.store') }}" method="POST" enctype="multipart/form-data">
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

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Beasiswa</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                                  class="mt-1 block w-full px-3 py-2 border @error('deskripsi') border-red-500 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocomplete="on">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Beasiswa -->
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
                                    <input type="radio" id="half" name="jenis_beasiswa" value="half"
                                        class="form-radio h-5 w-5 text-blue-500 rounded-full @error('jenis_beasiswa') border-red-500 @enderror focus:ring-blue-500"
                                        {{ old('jenis_beasiswa') == 'half' ? 'checked' : '' }}>
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
                                     value="{{old('tanggal_mulai')}}"
                                     autocomplete="on">
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
                                value="{{old('tanggal_berakhir')}}"
                                autocomplete="on">
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
                        <div id="selected-tags-jenjang" class="flex flex-wrap gap-2 mb-2">
                        </div>
                        <input type="search" id="jenjang_pendidikan" name="input_jenjang_pendidikan" placeholder="Jenjang Pendidikan"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        oninput="fetchJenjangTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); }">
                        <div id="jenjang-suggestions" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto "></div>
                        <div id="tag-counter-jenjang" class="mb-2 text-sm text-gray-600">Jumlah jenjang yang dipilih: 0</div>
                    </div>
                    

                    <!-- Syarat Beasiswa -->
                    <div class="relative">
                        <label for="syarat_beasiswa" class="block text-sm font-medium text-gray-700">Syarat-Syarat Beasiswa</label>
                        <div id="selected-tags-syarat" class="flex flex-wrap gap-2 mb-2">
                        </div>

                        <input type="search" id="syarat_beasiswa" name="input_syarat_beasiswa" placeholder="Syarat-syarat Beasiswa"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        oninput="fetchBeasiswaTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); addBeasiswaTag(this.value); this.nextElementSibling.classList.add('hidden');}">
                        <div id="syarat-suggestions-beasiswa" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                        <div id="tag-counter-beasiswa" class="mb-2 text-sm text-gray-600">Jumlah syarat yang dipilih: 0</div>
                    </div>

                    <!-- Benefit Beasiswa -->
                    <div class="relative">
                        <label for="benefit_beasiswa" class="block text-sm font-medium text-gray-700">Benefit Beasiswa</label>
                        <div id="selected-tags-benefit" class="flex flex-wrap gap-2 mb-2">
                        </div>
                        
                        <input type="search" id="benefit_beasiswa" name="input_benefit_beasiswa" placeholder="Benefit Beasiswa"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        oninput="fetchBenefitTags()" autocomplete="off" onkeydown="if (event.keyCode === 13) { event.preventDefault(); addBenefitTag(this.value); this.nextElementSibling.classList.add('hidden');}">
                        <div id="benefit-suggestions-beasiswa" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                        <div id="tag-counter-benefit" class="mb-2 text-sm text-gray-600">Jumlah benefit yang dipilih: 0</div>
                    </div>

                    <div id="form-container">
                        <div class="grid grid-cols-12 gap-4 items-center" id="form-row-1">
                            <!-- Input Syarat Dokumen -->
                            <div class="col-span-6 relative">
                                <label for="dokumen-1" class="block text-sm font-medium text-gray-700 mb-1">Syarat Dokumen</label>
                                <input
                                    type="text"
                                    id="dokumen-1"
                                    name="nama_dokumen[]" 
                                    placeholder="Masukkan dokumen"
                                    class="syarat_dokumen col-span-2 w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    oninput="fetchDokumenTags(1)"
                                    onkeydown="handleDokumenKeydown(event, 1)"
                                />
                                <div id="syarat-suggestions-dokumen-1" 
                                     class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                            </div>
                    
                            <!-- Input Unggah Format Dokumen -->
                            <div class="col-span-5">
                                <label for="unggah-1" class="block text-sm font-medium text-gray-700 mb-1">Unggah Format Dokumen</label>
                                <input
                                    type="file"
                                    id="unggah-1"
                                    class="w-1/3 text-gray-500 file:mr-6 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                    name="dokumen_file[]"
                                    onchange="addDokumenFile(this.files[0], 1)"
                                />
                                <span id="dokumen-name-1" class="w-2/3 text-gray-500 ml-[-15px] bg-white">Belum ada file yang dipilih</span>
                            </div>
                    
                            <div class="col-span-1 justify-center flex items-center mt-7">
                                <div class="bg-red-400 hover:bg-red-600 rounded">
                                    <button
                                        type="button"
                                        class="px-3 text-sm font-medium"
                                        onclick="removeFormRow(1)"
                                    >
                                        X
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tombol Tambah Syarat Dokumen -->
                    <div class="mt-4">
                        <button
                            type="button"
                            id="add-button"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium"
                            onclick="createFormRow()"
                        >
                            <span class="text-xl mr-1">+</span> Tambahkan Syarat Dokumen
                        </button>
                    </div>
                
                    
                    <br>
                    <p class="@error('poster') border-red-500 @enderror block text-sm font-medium text-gray-700">Poster Beasiswa</p>
                    <div class="mb-4">
                        <label for="poster_beasiswa" class="cursor-pointer block w-full px-3 py-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <span id="file-name" class="ml-2 text-gray-600">Pilih file</span>
                            <input type="file" id="poster_beasiswa" name="poster[]" class="hidden" accept="image/*" multiple onchange="displayFileNamesAndPreview()">
                        </label>
                        @error('poster')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button onclick="event.preventDefault(); removeAllFiles();" class="text-red-500 ml-2 hover:underline">Hapus Semua</button>
                    <div id="preview-container" class="flex flex-wrap gap-4 mt-2"></div> <!-- Preview gambar -->

                    <!-- Modal untuk menampilkan gambar besar -->
                    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="relative max-w-full max-h-full">
                            <img id="modal-image" class="max-w-screen max-h-screen object-contain rounded-md shadow-lg">
                            <button id="close-modal" class="absolute top-2 right-2 bg-white text-black rounded-full p-1" onclick="event.preventDefault()">X</button>
                        </div>
                    </div>
                    <div id="hidden-input-container"></div>
                    <div>
                        <button type="submit" style="background-color: #FF8E07" class="block w-full items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  hover:bg-[#D97600] ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- popup --}}
  
    <div id="popup" class="fixed inset-0 bg-opacity-50 backdrop-blur-md hidden flex items-center justify-center z-50">
        <div class="bg-white w-full sm:w-3/4 p-6 sm:p-8 rounded-3xl shadow-xl max-w-lg mx-auto relative">
            {{-- Tombol Close --}}
            <div class="absolute top-4 right-4">
                <button onclick="hidePopup()" aria-label="Close" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
    
            {{-- Header --}}
            <h2 class="text-2xl font-semibold mb-6 text-gray-800 text-center">Pilih Template Beasiswa</h2>
    
            {{-- Daftar Template Beasiswa --}}
            <ul id="template-list" class="space-y-4">
                <li id="loading-indicator" class="text-center text-gray-600">Memuat template...</li>
            </ul>

            <div id="pagination-controls" class="py-3 hidden"></div>
        </div>
    </div>            
    
    @endif
    <script>
        
        let formCounter = 1; // Hitung jumlah input dokumen
        let selectedDokumen = [];
        var selectedFiles = []; // Menyimpan file yang dipilih

        if (typeof dokumen_tags === 'undefined') {
            var dokumen_tags = []; // Initialize dokumen_tags array if it is not already defined
        }
        if (typeof syarat_tags === 'undefined') {
            var syarat_tags = []; // Initialize syarat_tags array if it is not already defined
        }
        if (typeof benefit_tags === 'undefined') {
            var benefit_tags = []; // Initialize benefit_tags array if it is not already defined
        }
        if (typeof jenjang_tags === 'undefined') {
            var jenjang_tags = []; // Initialize jenjang_tags array if it is not already defined
        }


        
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
            renderTags('jenjang');
            updateJenjangCounter();
            $('#jenjang_pendidikan').val('');
        }

        function updateJenjangCounter() {
            document.getElementById("tag-counter-jenjang").textContent = "Jumlah jenjang pendidikan yang dipilih: " + jenjang_tags.length;
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
            renderTags('syarat');
            updateBeasiswaCounter();
            $('#syarat_beasiswa').val('');
        }

        function updateBeasiswaCounter() {
            document.getElementById("tag-counter-beasiswa").textContent = "Jumlah syarat beasiswa yang dipilih: " + syarat_tags.length;
        }

        // Similar functions for dokumen
        function fetchDokumenTags(dokumenID) {
            element = $(`#dokumen-${dokumenID}`)
            if (element.prop('readonly')) {return;}
            query = element.val().trim();
            if (query === '') {
                $(`#syarat-suggestions-dokumen-${dokumenID}`).addClass('hidden');
                return;
            }
            if (dokumen_tags.includes(query)){
                $(`#syarat-suggestions-dokumen-${dokumenID}`).addClass('hidden');
                return;
            }
            $.ajax({
                url: "{{ route('Beasiswa.search_dokumen') }}",
                type: 'GET',
                data: { query: query },
                success: function(tags) {
                    suggestions = $(`#syarat-suggestions-dokumen-${dokumenID}`).empty().removeClass('hidden');
                    if (!tags.length) {
                        suggestions.addClass('hidden');
                        return;
                    }
                    tags.forEach(tag => {
                        suggestions.append(`
                            <div class="tag-suggestion-dokumen px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer" data-name="${tag.dokumen}" data-link-dokumen="${tag.link_dokumen}">
                                ${tag.dokumen}
                            </div>
                        `);
                    });

                    $('.tag-suggestion-dokumen').on('click', function() {
                        addDokumenTag($(this).text().trim(), dokumenID);
                        addDokumenFile($(this).data('link-dokumen'), dokumenID); // kirimkan link_dokumen ke fungsi addDokumenFile
                        suggestions.empty().addClass('hidden');
                    });
                }
            });
        }

        function addDokumenTag(tagText, dokumenID) {
            tagText = tagText.trim();
            const dokumen_input_field = $(`#dokumen-${dokumenID}`);

            if (dokumen_input_field.prop('readonly')) {
                return;
            } else if (dokumen_tags.includes(tagText)) {
                // Tambahkan tanda pada input dan tampilkan alert
                dokumen_input_field.addClass("border-red-500"); // Beri warna merah pada border
                alert("Tag sudah ada!");
                // dokumen_input_field.val(''); // Kosongkan input
                return;
            }

            if (tagText === '') {
                alert("Field tag kosong!");
                return;
            }

            // Tambahkan tag ke array dan set nilai input menjadi readonly
            dokumen_tags.push(tagText);

            dokumen_input_field.val(tagText);
            dokumen_input_field.prop('readonly', true);

            console.log(`Tag "${tagText}" berhasil ditambahkan.`);
        }


        function updateDokumenCounter() {
            let count = dokumen_tags.length;
            document.getElementById("tag-counter-dokumen").textContent = "Jumlah syarat dokumen yang dipilih: " + count;
        }

        function addDokumenFile(link, dokumenID) {
            const dokumen_name_span = $(`#dokumen-name-${dokumenID}`); // Assuming you have unique ids for each span, like dokumen-name-1, dokumen-name-2

            if (!(typeof link === 'string') && !(link instanceof File)){
                console.error('Invalid input: Expected a string or a File object');
            } else if (typeof link === 'string') {
                // Extract the filename from the link
                const filename = link.split('/').pop();
    
                // Modify the span text to indicate that the file has been added
                dokumen_name_span.text(filename); // Update the span text to show the filename
    
                // Store the link as a data attribute on the span element
                dokumen_name_span.attr('data-link', link); // Store the link in a data attribute (data-link)  
                console.log("url added");
            } else if (link instanceof File) {
                // Case 2: link is a File (from input[type="file"])
                const filename = link.name;  // Get the filename from the File object
                dokumen_name_span.text(filename);  // Update the span text with the filename
                dokumen_name_span.attr('data-link', URL.createObjectURL(link));  // Store a temporary URL for the file as a data attribute
                console.log("file added");
            } 

            url = dokumen_name_span.attr('data-link');
            selectedDokumen.push(url);
            console.log(selectedDokumen);
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
            renderTags('benefit');
            updateBenefitCounter();
            $('#benefit_beasiswa').val('');
        } 

        function updateBenefitCounter() {
            document.getElementById("tag-counter-benefit").textContent = "Jumlah benefit beasiswa yang dipilih: " + benefit_tags.length;
        }

        function renderTags(tagCategory) {
            // Get the tag container based on category
            const tagContainer = $(`#selected-tags-${tagCategory}`);

            // Clear the container to avoid duplicates
            tagContainer.empty();

            // Check if the category exists in the tagData
            if (tagCategory === 'benefit') {
                // Loop through the tags and render each
                benefit_tags.forEach(tagText => {
                    tagContainer.append(`
                        <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                            ${tagText}
                            <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, '${tagCategory}_tags');">×</span>
                            <input type="hidden" name="${tagCategory}_beasiswa[]" value="${tagText}">
                        </div>
                    `);
                });
            } else if (tagCategory === 'syarat') {
                syarat_tags.forEach(tagText => {
                    tagContainer.append(`
                        <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                            ${tagText}
                            <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, '${tagCategory}_tags');">×</span>
                            <input type="hidden" name="${tagCategory}_beasiswa[]" value="${tagText}">
                        </div>
                    `);
                });
            } else if (tagCategory === 'jenjang') {
                jenjang_tags.forEach(tagText => {
                    tagContainer.append(`
                        <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
                            ${tagText}
                            <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, '${tagCategory}_tags');">×</span>
                            <input type="hidden" name="${tagCategory}_pendidikan[]" value="${tagText}">
                        </div>
                    `);
                });
            } else {
                console.error(`Unknown tag category: ${tagCategory}`);
            }
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

        // Preview gambar
        document.getElementById('poster_beasiswa').addEventListener('change', function () {
            if (this.files.length > 3) {
                alert("Anda hanya dapat mengupload maksimal 3 file.");
                this.value = ""; // Reset file input
            }
        });


        function displayFileNamesAndPreview() {
            const input = document.getElementById('poster_beasiswa');
            
            // Tambahkan file yang baru dipilih ke dalam array selectedFiles
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                
                if (selectedFiles.length > 2) {
                    alert("Anda hanya dapat mengupload maksimal 3 file.");
                    input.value = "";
                    break;
                }
                // Pastikan file belum ada di array
                if (!selectedFiles.some(item => item.name === file.name && item.lastModified === file.lastModified)) {
                    selectedFiles.push(URL.createObjectURL(file));
                }
            }

            // Simpan file yang dipilih ke sessionStorage
            // selectedFiles = Array.from(input.files);
            console.log(selectedFiles);
            // saveFilesToStorage(selectedFiles);
            
            renderPreviews(selectedFiles);  // Tampilkan pratinjau untuk file yang dipilih
        }

        function saveFilesToStorage(files) {
            let fileUrls = [];
            
            // Ambil data URL dari setiap file dan simpan ke sessionStorage
            Array.from(files).forEach(file => {
                if (file instanceof File) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        fileUrls.push(e.target.result);
                        // Setelah semua file diproses, simpan ke sessionStorage
                        if (fileUrls.length === files.length) {
                            sessionStorage.setItem('uploadedFiles', JSON.stringify(fileUrls));
                            
                            // Lakukan operasi penambahan (misalnya mengirim data ke server)
                            addFilesToServer(fileUrls).then(() => {
                                // Hapus data dari sessionStorage setelah operasi selesai
                                sessionStorage.removeItem('uploadedFiles');
                            }).catch(error => {
                                console.error("Error during file upload:", error);
                            });
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Contoh fungsi untuk menambahkan file ke server
        async function addFilesToServer(fileUrls) {
            // Gantikan dengan logika pengiriman file ke server
            return new Promise((resolve, reject) => {
                // Simulasi pengiriman ke server
                setTimeout(() => {
                    console.log("Files uploaded:", fileUrls);
                    resolve();
                }, 1000);
            });
        }


        function convertDataUrlsToFilesAndAddToInput() {
            const fileUrls = JSON.parse(sessionStorage.getItem('uploadedFiles'));
            if (!fileUrls) {
                console.log('No uploaded files found in sessionStorage');
                if (selectedFiles) {
                    return selectedFiles;
                }
                return;
            }

            // Membuat objek DataTransfer untuk menyimpan file yang telah dikonversi
            const dataTransfer = new DataTransfer();

            fileUrls.forEach((dataUrl, index) => {
                const byteString = atob(dataUrl.split(',')[1]);  // Decode the base64 data
                const mimeString = dataUrl.split(',')[0].split(':')[1].split(';')[0];  // Extract mime type

                // Create an array buffer to hold the binary data
                const arrayBuffer = new ArrayBuffer(byteString.length);
                const uintArray = new Uint8Array(arrayBuffer);
                
                // Copy the byteString to the array buffer
                for (let i = 0; i < byteString.length; i++) {
                    uintArray[i] = byteString.charCodeAt(i);
                }

                // Create a Blob from the array buffer
                const blob = new Blob([arrayBuffer], { type: mimeString });

                // Create a file object from the Blob
                const file = new File([blob], `file_${index + 1}`, { type: mimeString });

                // Add the file to the DataTransfer object
                dataTransfer.items.add(file);
            });

            // Mendapatkan input file dan menambahkan file ke dalamnya
            const input = document.querySelector('input[type="file"]');
            input.files = dataTransfer.files;  // Menyimpan files ke dalam input.files
            return input.files;  // Cek hasilnya
        }

        
        function renderPreviews() {
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = ''; // Kosongkan kontainer preview

            selectedFiles.forEach((file, index) => {
                if (file instanceof File){
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
                } else if (typeof file === 'string'){
                    const imgContainer = document.createElement('div');
                    imgContainer.classList.add('relative', 'w-24', 'h-24', 'mb-2', 'mr-2');

                    const img = document.createElement('img');
                    img.src = file; // Menggunakan file sebagai URL langsung
                    img.alt = getFileName(file);
                    img.classList.add('w-full', 'h-full', 'object-cover', 'rounded-md', 'shadow-sm');

                    // Fungsi untuk memperbesar gambar saat diklik
                    img.onclick = () => openModal(file); 

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
                    console.log("image rendered")
                }
            });
        }
        
        function removeFile(index) {
            selectedFiles.splice(index, 1); // Hapus file dari array `selectedFiles`
            renderPreviews(); // Perbarui preview gambar
        }

        function removeAllFiles() {
            // Kosongkan array selectedFiles
            selectedFiles.splice(0, selectedFiles.length);

            // Perbarui daftar file dan preview
            renderPreviews();
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

        function getFileName(url) {
            // Extract the filename from the Firebase Storage URL
            const parts = url.split('/');
            const fileName = parts[parts.length - 2]; // Get the second-to-last part (filename)

            // Remove any percent-encoding from the filename
            const decodedFileName = decodeURIComponent(fileName);

            return decodedFileName;
        }

        @foreach (old('syarat_dokumen', []) as $old_dokumen_tag )
            addDokumenTag(@json(@$old_dokumen_tag));
        @endforeach
        @foreach (old('syarat_beasiswa', []) as $old_syarat_tag )
            addBeasiswaTag(@json(@$old_syarat_tag));
        @endforeach
        @foreach (old('benefit_beasiswa', []) as $old_benefit_tag )
            addBenefitTag(@json(@$old_benefit_tag));
        @endforeach
        @foreach (old('jenjang_pendidikan', []) as $old_jenjang_tag )
            addJenjangTag(@json(@$old_jenjang_tag));
        @endforeach


    
        // Fungsi untuk menambahkan input baru
        // document.getElementById("add-button").addEventListener("click", function () {
        //     createFormRow();
        // });
    
        // Membuat form row baru
        function createFormRow() {
            if (typeof formCounter === 'undefined') {let formCounter = 1;}
            console.log("creating form");
            formCounter++;
            console.log(formCounter);

            const formContainer = document.getElementById("form-container");
            const newFormRow = document.createElement("div");
            newFormRow.className = "mt-3 grid grid-cols-12 gap-4 items-center";
            newFormRow.id = `form-row-${formCounter}`;
    
            newFormRow.innerHTML = `
                <div class="col-span-6 relative">
                    <input
                        type="text"
                        id="dokumen-${formCounter}"
                        name="nama_dokumen[]" 
                        placeholder="Masukkan dokumen"
                        class="syarat_dokumen col-span-2 w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        oninput="fetchDokumenTags(${formCounter})"
                        onkeydown="handleDokumenKeydown(event, ${formCounter})"
                    />
                    <div id="syarat-suggestions-dokumen-${formCounter}" 
                            class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-48 overflow-y-auto"></div>
                </div>
                <div class="col-span-5">
                    <label for="unggah-${formCounter}" class="block text-sm font-medium text-gray-700 mb-1"></label>
                    <input
                        type="file"
                        id="unggah-${formCounter}"
                        class="w-1/3 text-gray-500 file:mr-6 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" 
                        name="dokumen_file[]" 
                        onchange="addDokumenFile(this.files[0], ${formCounter})"
                    />
                    <span id="dokumen-name-${formCounter}" class="w-2/3 text-gray-500 ml-[-15px] bg-white">Belum ada file yang dipilih</span>
                </div>
    
                <div class="col-span-1 justify-center flex items-center">
                    <div class="bg-red-400 hover:bg-red-600 rounded">
                        <button
                            type="button"
                            class="px-3 text-sm font-medium"
                            onclick="removeFormRow(${formCounter})"
                        >
                            X
                        </button>
                    </div>
                </div>
            `;
            formContainer.appendChild(newFormRow);
        }
    
        // Fungsi untuk menghapus baris form
        function removeFormRow(rowId) {
            const tagText = document.getElementById(`dokumen-${rowId}`).value.trim();
            const link = document.getElementById(`dokumen-name-${rowId}`).getAttribute('data-link');
    
            if (rowId === 1) {
                document.getElementById(`dokumen-${rowId}`).value = '';
                document.getElementById(`dokumen-${rowId}`).readOnly = false;
                document.getElementById(`dokumen-name-${rowId}`).textContent = 'Belum ada file yang dipilih';
            } else {
                const rowToRemove = document.getElementById(`form-row-${rowId}`);
                if (rowToRemove) {
                    rowToRemove.remove();
                }
            }
    
            dokumen_tags = dokumen_tags.filter(tag => tag !== tagText);
            selectedDokumen = selectedDokumen.filter(ulink => ulink !== link);

            console.log(selectedDokumen);
            formCounter--;
        }
    
        // Fungsi untuk menangani keydown pada input dokumen
        function handleDokumenKeydown(event, rowId) {
            const inputField = document.getElementById(`dokumen-${rowId}`);
            if (inputField.readOnly) {
                event.preventDefault(); // Block Enter if readonly
                return;
            }

            if (event.keyCode === 13) { // Enter key
                event.preventDefault(); // Block Enter if readonly
                const tagText = inputField.value.trim();
                if (tagText) {
                    addDokumenTag(tagText, rowId);
                    // Mendapatkan semua elemen dengan atribut data-name
                    const elements = document.querySelectorAll('[data-name]');
                    elements.forEach(element => {
                        if(element.getAttribute('data-name') === tagText) {
                            elementLink = element.getAttribute('data-link-dokumen');
                            addDokumenFile(elementLink, rowId);
                            element.classList.add('hidden');
                        }
                    })
                }
                // inputField.readOnly = true;
                $(`#syarat-suggestions-dokumen-${rowId}`).empty().addClass('hidden');
            }
        }

        let currentPage = 1; // Menyimpan halaman saat ini
        let last_page = 1;

        function showPopup() {
            document.getElementById('popup').classList.remove('hidden');
            loadTemplates(currentPage);
        }

        function loadTemplates(page) {
            const templateList = document.getElementById('template-list');
            const paginationControls = document.getElementById('pagination-controls');
            
            // Menampilkan indikator loading
            templateList.innerHTML = '<li id="loading-indicator" class="text-center text-gray-600">Memuat template...</li>';

            // Ambil data template dengan paginasi menggunakan fetch
            fetch(`/beasiswa/get-templates?page=${page}`, {
                headers: {
                    'Accept': 'application/json', // Memastikan respons berupa JSON
                }})
                .then(response => response.json())
                .then(data => {
                    last_page = data.last_page;
                    console.log('Response Data:', data); // Debugging keseluruhan respons
                    if (!data.data || !Array.isArray(data.data)) {
                        console.log('Data content:', data.data); // Debugging hanya bagian data
                        throw new Error('Invalid data format: data.data is not an array');
                    }
                    
                    // Bersihkan indikator loading
                    templateList.innerHTML = '';
                    
                    // Menampilkan data template
                    data.data.forEach(template => {
                        const listItem = document.createElement('li');
                        listItem.className = 'p-4 bg-gray-100 rounded-lg flex justify-between items-center';
                        listItem.innerHTML = `
                            <div>
                                <p class="text-lg font-medium text-gray-800">${template.nama_beasiswa}</p>
                                <p class="text-sm text-gray-600">${template.deskripsi}</p>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                                    onclick="selectTemplate('${template.id}')">
                                Pilih
                            </button>
                        `;
                        templateList.appendChild(listItem);
                    });

                    // Menampilkan tombol navigasi halaman
                    paginationControls.classList.remove('hidden');
                    paginationControls.innerHTML = `
                        <button onclick="changePage(${data.current_page - 1})" ${data.current_page === 1 ? 'disabled' : ''} class="px-4 py-2 bg-gray-300 rounded-md"><</button>
                        <span class="px-4 py-2">${data.current_page} of ${data.last_page}</span>
                        <button onclick="changePage(${data.current_page + 1})" ${data.current_page === data.last_page ? 'disabled' : ''} class="px-4 py-2 bg-gray-300 rounded-md">></button>
                    `;
                })
                .catch(error => {
                    templateList.innerHTML = '<li class="text-center text-red-600">Gagal memuat template.</li>';
                    console.error('Error fetching templates:', error);
                });
        }

        function changePage(page) {
            if (page < 1 || page > last_page) return; // Cek apakah halaman valid, jangan lupa sesuaikan batas dengan last_page
            currentPage = page;
            const paginationControls = document.getElementById('pagination-controls');
            paginationControls.classList.add('hidden');
            loadTemplates(currentPage);
        }

        function hidePopup() {
            document.getElementById('popup').classList.add('hidden');
        }


        function cleanInputFields() {
            // Membersihkan input
            document.getElementById('nama_beasiswa').value = "";
            document.getElementById('sumber_beasiswa').value = "";
            document.getElementById('deskripsi').value = "";

            // Set dates
            document.getElementById('tanggal_mulai').value = "";
            document.getElementById('tanggal_berakhir').value = "";
            document.getElementById('kuota_beasiswa').value = "";

            // Process arrays (poster, syarat, dokumen, etc.)
            selectedFiles = [];
            renderPreviews();  

            jenjang_tags = [];
            renderTags('jenjang');
            syarat_tags = [];
            renderTags('syarat');
            benefit_tags = [];
            renderTags('benefit');

            // Assuming addBeasiswaTag, addDokumenTag, etc., are functions to process each array

            console.log("Deleting dokumen..");
            console.log(dokumen_tags);
            dokumen_tags.forEach((item, index) => {
                console.log(item, index+1);
                removeFormRow(index+1);  // Assuming this function handles creating new rows for documents
            });
            formCounter = 1;
        }

        function selectTemplate(templateID) {
            cleanInputFields();
            fetch(`get-beasiswa/${templateID}`)
                .then(response => response.json())
                .then(data => {
                    const template = data.beasiswa;  // The main beasiswa data
                    
                    // Populate form fields
                    document.getElementById('nama_beasiswa').value = template.nama_beasiswa;
                    document.getElementById('sumber_beasiswa').value = template.sumber;
                    document.getElementById('deskripsi').value = template.deskripsi;

                    // Set radio buttons for jenis_beasiswa
                    document.getElementsByName('jenis_beasiswa').forEach(radio => {
                        if (radio.value === template.jenis_beasiswa) {
                            radio.checked = true;
                        }
                    });

                    // Set radio buttons for tipe_beasiswa
                    document.getElementsByName('tipe_beasiswa').forEach(radio => {
                        if (radio.value === template.tipe_beasiswa) {
                            radio.checked = true;
                        }
                    });

                    // Set dates
                    document.getElementById('tanggal_mulai').value = template.tanggal_mulai;
                    document.getElementById('tanggal_berakhir').value = template.tanggal_berakhir;
                    document.getElementById('kuota_beasiswa').value = template.kuota;

                    // Process arrays (poster, syarat, dokumen, etc.)
                    data.poster.forEach(poster => {
                        selectedFiles.push(poster);
                        console.log("existing poster ", selectedFiles);
                        renderPreviews(selectedFiles);  // Assuming renderPreviews handles displaying the file
                    });

                    // Assuming addBeasiswaTag, addDokumenTag, etc., are functions to process each array
                    data.syarat.forEach(item => addBeasiswaTag(item));
                    console.log("Inserting dokumen");
                    console.log(data.dokumen);
                    data.dokumen.forEach((item, index) => {
                        console.log(item, index + 1);
                        addDokumenTag(item, index + 1);
                        if (index !== data.dokumen.length - 1) {
                            createFormRow();
                        }
                    });
                    data.link_dokumen.forEach((item, index) => {
                        addDokumenFile(item, index + 1);  // Assuming this handles document file rendering
                    });
                    data.jenjang.forEach(item => addJenjangTag(item));
                    data.benefit.forEach(item => addBenefitTag(item));

                    // Hide the popup (assuming hidePopup is defined elsewhere)
                    hidePopup();
                })
                .catch(error => {
                    console.error('Error fetching template:', error);
                });
        }

        const form = document.getElementById('beasiswa-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            createHiddenInput();
            form.submit();
        })

        function createHiddenInput() {
            const hiddenContainer = document.getElementById('hidden-input-container');

            // Kosongkan input tersembunyi sebelumnya
            hiddenContainer.innerHTML = '';

            // Tambahkan selectedFiles ke input tersembunyi
            selectedFiles.forEach((file, index) => {
                if (typeof file === "string") {
                    // Jika file adalah URL, tambahkan URL
                    const hiddenInput = document.createElement('input');
                    hiddenInput.name = 'poster[]';
                    hiddenInput.type = 'hidden';
                    hiddenInput.value = file;
                    hiddenContainer.appendChild(hiddenInput);
                }
            });

            selectedDokumen.forEach((file, index) => {
                // Regex untuk validasi URL
                const urlPattern = new RegExp(
                    '^(https?:\\/\\/)?' + // protocol
                    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                    '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                    '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                    '(\\#[-a-z\\d_]*)?$', // fragment locator
                    'i'
                );

                if (urlPattern.test(file)) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.name = 'link_dokumen[]';
                    hiddenInput.type = 'hidden';
                    hiddenInput.value = file;
                    hiddenContainer.appendChild(hiddenInput);
                } else {
                    console.warn(`Invalid URL skipped: ${file}`);
                }
            });

            // dd(selectedFiles);
        }
    </script>

@if ($beasiswa != null)
<script>

    var beasiswa =  {!! json_encode($beasiswa, JSON_HEX_TAG) !!} 
    var syarat =  {!! json_encode($syarat, JSON_HEX_TAG) !!} 
    var jenjang =  {!! json_encode($jenjang, JSON_HEX_TAG) !!} 
    var dokumen =  {!! json_encode($dokumen, JSON_HEX_TAG) !!} 
    var link_dokumen =  {!! json_encode($link_dokumen, JSON_HEX_TAG) !!} 
    var benefit =  {!! json_encode($benefit, JSON_HEX_TAG) !!} 
    var poster =  {!! json_encode($poster, JSON_HEX_TAG) !!} 
    
    window.onload = function() {
        poster.forEach(poster => {
            selectedFiles.push(poster);
            console.log(selectedFiles);
            renderPreviews(selectedFiles);  // Tampilkan pratinjau untuk file yang dipilih
        });
        syarat.forEach(item => addBeasiswaTag(item));
        console.log(dokumen)
        dokumen.forEach((item, index) => {
            addDokumenTag(item, index + 1);
            if (index !== dokumen.length - 1) {
                createFormRow();
            }
        });
        link_dokumen.forEach((item, index) => {
            addDokumenFile(item, index + 1);
        });
        jenjang.forEach(item => addJenjangTag(item));
        benefit.forEach(item => addBenefitTag(item));
    }
</script>
@endif

