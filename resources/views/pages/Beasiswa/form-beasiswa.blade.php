@extends('layouts.main')
@section('content')
    @include('component.navbar',['path'=>"Tambah Beasiswa",'id'=>null])

<div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg p-6">
        <form action="{{ route('beasiswa.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Nama Beasiswa -->
                    <div>
                        <label for="nama_beasiswa" class="block text-sm font-medium text-gray-700">Nama Beasiswa</label>
                        <input type="text" id="nama_beasiswa" name="nama_beasiswa" placeholder="Nama Beasiswa"
                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                    </div>

                    <!-- Sumber Beasiswa -->
                    <div>
                        <label for="sumber_beasiswa" class="block text-sm font-medium text-gray-700">Sumber Beasiswa</label>
                        <input type="text" id="sumber_beasiswa" name="sumber_beasiswa" placeholder="Sumber Beasiswa"
                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Beasiswa</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="block text-sm font-medium text-gray-700">Jenjang Pendidikan</p>
                        <div class="mb-4">
                            <label for="D3" class="flex items-center space-x-3">
                                <input type="checkbox" id="D3" name="jenjang_pendidikan[]" value="D3" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <span class="text-gray-600">D3</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label for="D4" class="flex items-center space-x-3">
                                <input type="checkbox" id="D4" name="jenjang_pendidikan[]" value="D4" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <span class="text-gray-600">D4</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <p class="block text-sm font-medium text-gray-700">Jenis Beasiswa</p>
                        <div class="mb-4">
                            <label for="full" class="flex items-center space-x-3">
                                <input type="radio" id="full" name="jenis_beasiswa" value="full" class="form-radio h-5 w-5 text-blue-500 rounded-full border-gray-300 focus:ring-blue-500">
                                <span class="text-gray-600">Full</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label for="half" class="flex items-center space-x-3">
                                <input type="radio" id="half" name="jenis_beasiswa" value="setengah" class="form-radio h-5 w-5 text-blue-500 rounded-full border-gray-300 focus:ring-blue-500">
                                <span class="text-gray-600">Half</span>
                            </label>
                        </div>
                    </div>
                </div>
                <p class="block text-sm font-medium text-gray-700">Tipe Beasiswa</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="mb-4">
                        <label for="prestasi" class="flex items-center space-x-3">
                            <input type="radio" id="prestasi" name="tipe_beasiswa" value="prestasi" class="form-radio h-5 w-5 text-blue-500 rounded-full border-gray-300 focus:ring-blue-500">
                            <span class="text-gray-600">Prestasi</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label for="ekonomi" class="flex items-center space-x-3">
                            <input type="radio" id="ekonomi" name="tipe_beasiswa" value="ekonomi" class="form-radio h-5 w-5 text-blue-500 rounded-full border-gray-300 focus:ring-blue-500">
                            <span class="text-gray-600">Ekonomi</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label for="eksternal" class="flex items-center space-x-3">
                            <input type="radio" id="eksternal" name="tipe_beasiswa" value="eksternal" class="form-radio h-5 w-5 text-blue-500 rounded-full border-gray-300 focus:ring-blue-500">
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
                                class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                        </div>
                    </div>

                    <!-- Tanggal Berakhir -->
                    <div>
                        <label for="tanggal_berakhir" class="block text-sm font-medium text-gray-700">Tanggal Berakhir</label>
                        <div class="relative mt-1">
                            <input type="date" id="tanggal_berakhir" name="tanggal_berakhir"
                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                        </div>
                    </div>
                </div>
                
                <!-- Kuota Beasiswa -->
                <div>
                    <label for="kuota_beasiswa" class="block text-sm font-medium text-gray-700">Kuota Beasiswa</label>
                    <input type="number" id="kuota_beasiswa" name="kuota_beasiswa" placeholder="Kuota Beasiswa"
                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                </div>
                <br>

                <h2 class="text-lg font-bold mb-4 block">Syarat-Syarat Beasiswa</h2>
                <div class="grid grid-cols-2 gap-10">
                    <!-- Syarat-Syarat Beasiswa -->
                    <div>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>IPK</label>
                                <input type="text" id="IPK_min" name="syarat_beasiswa[]" class="ml-2 w-16 border rounded p-1 text-center">
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="transkrip_nilai" name="syarat_beasiswa[]" value="Transkrip Nilai" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Transkrip Nilai</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="proposal" name="syarat_beasiswa[]" value="Proposal" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Proposal</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="esai" name="syarat_beasiswa[]" value="Esai" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Esai</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="sertifikat_prestasi" name="syarat_beasiswa[]" value="Sertifikat Prestasi" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Sertifikat Prestasi</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="suket_penghasilan" name="syarat_beasiswa[]" value="Surat Keterangan Penghasilan Orangtua" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Surat Keterangan Penghasilan Orangtua</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="suket_tidakmampu" name="syarat_beasiswa[]" value="Surat Keterangan Tidak Mampu" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Surat Keterangan Tidak Mampu</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="suket_rekomendasi" name="syarat_beasiswa[]" value="Surat Rekomendasi" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Surat Rekomendasi</label>
                            </div>
                        </div>
                    </div>

                    <!-- Benefit Beasiswa -->
                    <div>
                        <h2 class="text-lg font-bold mb-4">Benefit Beasiswa</h2>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Biaya Kuliah Penuh" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Biaya Kuliah Penuh</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Tunjangan Biaya Hidup" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Tunjangan Biaya Hidup</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Buku dan Perlengkapan Akademik" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                                <label>Buku dan Perlengkapan Akademik</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="benefit_beasiswa[]" value="Internship" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
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

