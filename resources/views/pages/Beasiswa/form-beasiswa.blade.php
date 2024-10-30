@extends('layouts.main')
@section('content')
    @include('component.navbar',['path'=>"Tambah Beasiswa",'id'=>null])

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
                            <input type="text" id="nama_beasiswa" name="nama_beasiswa" value="{{$beasiswa->nama_beasiswa}}" placeholder="Nama Beasiswa"
                                class="block w-full border @error('nama_beasiswa') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                            @error('nama_beasiswa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sumber Beasiswa -->
                        <div>
                            <label for="sumber_beasiswa" class="block text-sm font-medium text-gray-700">Sumber Beasiswa</label>
                            <input type="text" id="sumber_beasiswa" name="sumber_beasiswa" value="{{$beasiswa->sumber}}" placeholder="Sumber Beasiswa"
                                class="block w-full border @error('sumber_beasiswa') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                            @error('sumber_beasiswa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Beasiswa</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full px-3 py-2 border @error('deskripsi') border-red-500 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo $beasiswa->deskripsi?></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="block text-sm font-medium text-gray-700">Jenjang Pendidikan</p>
                            <div class="mb-4">
                                <label for="D3" class="flex items-center space-x-3">
                                    <input type="checkbox" id="D3" name="jenjang_pendidikan[]" value="D3" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                    @checked(in_array("D3", $jenjang))>
                                    <span class="text-gray-600">D3</span>
                                </label>
                            </div>
                            <div class="mb-4">
                                <label for="D4" class="flex items-center space-x-3">
                                    <input type="checkbox" id="D4" name="jenjang_pendidikan[]" value="D4" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                    @checked(in_array("D4", $jenjang))>
                                    <span class="text-gray-600">D4</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <p class="block text-sm font-medium text-gray-700">Jenis Beasiswa</p>
                            <div class="mb-4">
                                <label for="full" class="flex items-center space-x-3">
                                    <input type="radio" id="full" name="jenis_beasiswa" value="full" class="form-radio h-5 w-5 text-blue-500 rounded-full focus:ring-blue-500"
                                    @checked($beasiswa->jenis_beasiswa == "full")>
                                    <span class="text-gray-600">Full</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label for="half" class="flex items-center space-x-3">
                                <input type="radio" id="half" name="jenis_beasiswa" value="setengah" class="form-radio h-5 w-5 text-blue-500 rounded-full focus:ring-blue-500"
                                @checked($beasiswa->jenis_beasiswa == "setengah")>
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
                            @checked($beasiswa->tipe_beasiswa == "prestasi")>
                            <span class="text-gray-600">Prestasi</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label for="ekonomi" class="flex items-center space-x-3">
                            <input type="radio" id="ekonomi" name="tipe_beasiswa" value="ekonomi" class="form-radio h-5 w-5 text-blue-500 rounded-full focus:ring-blue-500"
                            @checked($beasiswa->tipe_beasiswa == "ekonomi")>
                            <span class="text-gray-600">Ekonomi</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label for="eksternal" class="flex items-center space-x-3">
                            <input type="radio" id="eksternal" name="tipe_beasiswa" value="external" class="form-radio h-5 w-5 text-blue-500 rounded-full focus:ring-blue-500"
                            @checked($beasiswa->tipe_beasiswa == "eksternal")>
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
                    <input type="number" id="kuota_beasiswa" name="kuota_beasiswa" placeholder="Kuota Beasiswa" value="{{$beasiswa->kuota}}"
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
                                       @if (collect($syarat)->contains(fn($s) => is_numeric($s)))
                                           checked
                                       @endif>
                                <label>IPK</label>
                                <input type="text" id="IPK_min" name="ipk_min" 
                                       class="ml-2 w-16 border rounded p-1 text-center" 
                                       value="{{ collect($syarat)->first(fn($s) => is_numeric($s)) }}"
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
                                @checked(collect($syarat)->contains("Transkrip Nilai"))>
                                <label>Transkrip Nilai</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="proposal" name="syarat_beasiswa[]" value="Proposal" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                @checked(collect($syarat)->contains("Proposal"))>
                                <label>Proposal</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="esai" name="syarat_beasiswa[]" value="Esai" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                @checked(collect($syarat)->contains("Esai"))>
                                <label>Esai</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="sertifikat_prestasi" name="syarat_beasiswa[]" value="Sertifikat Prestasi" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                @checked(collect($syarat)->contains("Sertifikat Prestasi"))>
                                <label>Sertifikat Prestasi</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="suket_penghasilan" name="syarat_beasiswa[]" value="Surat Keterangan Penghasilan Orangtua" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                @checked(collect($syarat)->contains("Surat Keterangan Penghasilan Orangtua"))>
                                <label>Surat Keterangan Penghasilan Orangtua</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="suket_tidakmampu" name="syarat_beasiswa[]" value="Surat Keterangan Tidak Mampu" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                @checked(collect($syarat)->contains("Surat Keterangan Tidak Mampu"))>
                                <label>Surat Keterangan Tidak Mampu</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="suket_rekomendasi" name="syarat_beasiswa[]" value="Surat Rekomendasi" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                @checked(collect($syarat)->contains("Surat Rekomendasi"))>
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
                                @checked(collect($benefit)->contains("Biaya Kuliah Penuh"))>
                                <label>Biaya Kuliah Penuh</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Tunjangan Biaya Hidup" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                @checked(collect($benefit)->contains("Tunjangan Biaya Hidup"))>
                                <label>Tunjangan Biaya Hidup</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Buku dan Perlengkapan Akademik" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                @checked(collect($benefit)->contains("Buku dan Perlengkapan Akademik"))>
                                <label>Buku dan Perlengkapan Akademik</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Internship" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" 
                                @checked(collect($benefit)->contains("Internship"))>
                                <label>Internship</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <p class="block text-sm font-medium text-gray-700">Poster Beasiswa</p>
                <div class="mb-4">
                    <label for="poster_beasiswa" class="cursor-pointer block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <i class="fa-duotone fa-solid fa-paperclip"></i>
                    <input type="file" id="poster_beasiswa" name="file_1" >
                    </label>
                </div>
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
            <form action="{{ route('beasiswa.store') }}" method="POST">
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
                     border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
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
             border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                            </div>
                            @error('tanggal_berakhir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Kuota Beasiswa -->
                    <div>
                        <label for="kuota_beasiswa" class="block text-sm font-medium text-gray-700">Kuota Beasiswa</label>
                        <input type="number" id="kuota_beasiswa" name="kuota_beasiswa" placeholder="Kuota Beasiswa"
                            class="block w-full border @error('kuota_beasiswa') border-red-500 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                    </div>
                    @error('kuota_beasiswa')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <br>

                    <h2 class="text-lg font-bold mb-4 block">Syarat-Syarat Beasiswa</h2>
                    <div class="grid grid-cols-2 gap-10">
                        <!-- Syarat-Syarat Beasiswa -->
                        <div>
                            <div class="space-y-2">
                                <div class="flex items-center space-x-3">
                                    <label>
                                        <input type="checkbox" id="ipk_checkbox" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" onclick="toggleIpkMin()" @error('ipk_min') checked  @enderror>
                                        IPK
                                        <input type="text" id="IPK_min" name="ipk_min" class="ml-2 w-16 border rounded p-1 text-center @error('ipk_min') border-red-500  @enderror" value="{{old('ipk_min')}}" disabled>
                                    </label>
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
                                    <input type="checkbox" id="transkrip_nilai" name="syarat_beasiswa[]" value="Transkrip Nilai" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('syarat_beasiswa')) && in_array('Transkrip Nilai', old('syarat_beasiswa'))) checked @endif>
                                    <label>Transkrip Nilai</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="proposal" name="syarat_beasiswa[]" value="Proposal" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('syarat_beasiswa')) && in_array('Proposal', old('syarat_beasiswa'))) checked @endif>
                                    <label>Proposal</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="esai" name="syarat_beasiswa[]" value="Esai" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"  @if(is_array(old('syarat_beasiswa')) && in_array('Esai', old('syarat_beasiswa'))) checked @endif>
                                    <label>Esai</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="space-y-2">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="sertifikat_prestasi" name="syarat_beasiswa[]" value="Sertifikat Prestasi" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"  @if(is_array(old('syarat_beasiswa')) && in_array('Sertifikat Prestasi', old('syarat_beasiswa'))) checked @endif>
                                    <label>Sertifikat Prestasi</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="suket_penghasilan" name="syarat_beasiswa[]" value="Surat Keterangan Penghasilan Orangtua" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500"  @if(is_array(old('syarat_beasiswa')) && in_array('Surat Keterangan Penghasilan Orangtua', old('syarat_beasiswa'))) checked @endif>
                                    <label>Surat Keterangan Penghasilan Orangtua</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="suket_tidakmampu" name="syarat_beasiswa[]" value="Surat Keterangan Tidak Mampu" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('syarat_beasiswa')) && in_array('Surat Keterangan Tidak Mampu', old('syarat_beasiswa'))) checked @endif>
                                    <label>Surat Keterangan Tidak Mampu</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="suket_rekomendasi" name="syarat_beasiswa[]" value="Surat Rekomendasi" class="form-checkbox h-5 w-5 text-blue-500 rounded-md focus:ring-blue-500" @if(is_array(old('syarat_beasiswa')) && in_array('Surat Rekomendasi', old('syarat_beasiswa'))) checked @endif>
                                    <label>Surat Rekomendasi</label>
                                </div>
                            </div>
                        </div>

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
                    <p class="block text-sm font-medium text-gray-700">Poster Beasiswa</p>
                    <div class="mb-4">  
                        <label for="poster_beasiswa" class="cursor-pointer block w-full px-3 py-3 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <i class="fa-duotone fa-solid fa-paperclip"></i>
                        <input type="file" id="poster_beasiswa" name="poster_beasiswa"class="hidden" disabled>
                        </label>
                    </div>
                    <div>
                        <button type="submit" style="background-color: #FF8E07" class="block w-full items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  hover:bg-[#D97600] ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif
