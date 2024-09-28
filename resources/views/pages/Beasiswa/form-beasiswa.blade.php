@extends('layouts.main')
@section('content')
    @include('component.navbar')

<div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white shadow-md rounded-lg p-6">
            <form>
                <div class="mb-4">
                    <label for="nama_beasiswa" class="block text-sm font-medium text-gray-700">Nama Beasiswa</label>
                    <input type="text" id="nama_beasiswa" name="nama_beasiswa"class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="deskripsi_beasiswa" class="block text-sm font-medium text-gray-700">Deskripsi Beasiswa</label>
                    <textarea id="deskripsi_beasiswa" name="deskripsi_beasiswa" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                
                <p class="block text-sm font-medium text-gray-700">Jenjang Pendidikan</p>
                <div class="mb-4">
                    <label for="D3" class="flex items-center space-x-3">
                        <input type="checkbox" id="D3" name="jenjang_pendidikan" value="D3" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                        <span class="text-gray-600">D3</span>
                    </label>
                </div>
                <div class="mb-4">
                    <label for="D4" class="flex items-center space-x-3">
                        <input type="checkbox" id="D4" name="jenjang_pendidikan" value="D4" class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-gray-300 focus:ring-blue-500" checked>
                        <span class="text-gray-600">D4</span>
                    </label>
                </div>
                <p class="block text-sm font-medium text-gray-700">Tipe Beasiswa</p>
                <div class="mb-4">
                    <label for="full" class="flex items-center space-x-3">
                        <input type="radio" id="full" name="jenjang_pendidikan" value="full" class="form-radio h-5 w-5 text-blue-500 rounded-full border-gray-300 focus:ring-blue-500">
                        <span class="text-gray-600">Full</span>
                    </label>
                </div>
                <div class="mb-4">
                    <label for="half" class="flex items-center space-x-3">
                        <input type="radio" id="half" name="jenjang_pendidikan" value="half" class="form-radio h-5 w-5 text-blue-500 rounded-full border-gray-300 focus:ring-blue-500">
                        <span class="text-gray-600">Half</span>
                    </label>
                </div>
                <p class="block text-sm font-medium text-gray-700">Poster Beasiswa</p>
                <div class="mb-4">  
                    <label for="poster_beasiswa" class="cursor-pointer block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <i class="fa-duotone fa-solid fa-paperclip"></i>
                    <input type="file" id="poster_beasiswa" name="poster_beasiswa"class="hidden">
                    </label>
                </div>
                <div>
                    <button type="submit" style="background-color: #FF8E07" class="block w-full items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  hover:bg-[#D97600] ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

