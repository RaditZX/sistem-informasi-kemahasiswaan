@extends('layouts.main')
@section('content')
    @include('component.navbar')

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
                                <input type="radio" id="half" name="jenis_beasiswa" value="half" class="form-radio h-5 w-5 text-blue-500 rounded-full border-gray-300 focus:ring-blue-500">
                                <span class="text-gray-600">Half</span>
                            </label>
                        </div>
                    </div>
                    
                </div>
                <p class="block text-sm font-medium text-gray-700">Poster Beasiswa</p>
                <div class="mb-4">  
                    <label for="poster_beasiswa" class="cursor-pointer block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <i class="fa-duotone fa-solid fa-paperclip"></i>
                    <input type="file" id="poster_beasiswa" name="poster_beasiswa"class="hidden" disabled>
                    </label>
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
                <div>
                    <button type="submit" style="background-color: #FF8E07" class="block w-full items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  hover:bg-[#D97600] ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

