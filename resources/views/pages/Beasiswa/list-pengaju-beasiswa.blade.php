@extends('layouts.filter')
@extends('layouts.main')
@section('content')
    @include('component.navbar', ['path' => 'List Pengaju Beasiswa', 'id' => null, 'notificationData'=>$notificationData])



    {{-- Filter, Tanngal Button dan Kolom Pencarian --}}
    <div class="p-2">
        <div class="flex flex-row-reverse p-5 gap-3">
            <div class="relative flex items-center">
                <i class="fas fa-search absolute left-3 text-gray-500"></i>
                <input type="text" placeholder="Cari"
                       class="pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full">
            </div>
            <div class="relative flex items-center">
                <i class="fas fa-filter absolute left-3 text-white"></i>
                <div class="pl-10 pr-4 py-2 bg-orange-500 rounded shadow-lg p-2 w-auto cursor-pointer" onclick="showPopup()">
                    <p class="text-xs sm:text-base text-white">Filter</p>
                </div>
            </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full table-fixed border border-none" >
            <thead>
                <tr>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Nama Pengaju</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Nama Beasiswa</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Penyelenggara</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Tanggal Pengajuan</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Status</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listPengajuan as $pengajuan )
                <tr class="border-2 rounded-3xl     ">

                        <td class="text-center py-5">{{ $pengajuan->nama_depan . $pengajuan->nama_belakang }}</td>
                        <td class="text-center py-5">{{ $pengajuan->nama_beasiswa }}</td>
                        <td class="text-center py-5">{{ $pengajuan->sumber }}</td>
                        <td class="text-center py-5">{{ $pengajuan->tanggal_pengajuan}}</td>

                    <td class="text-center py-5">
                        <div class="flex flex-row gap-2 justify-center items-center">
                            @if ($pengajuan->status <= 9)
                                <div class="bg-orange-500 rounded-lg shadow-lg p-3 w-28">
                                    <p class="text-xs sm:text-base text-white">Diproses</p>
                                </div>
                            @elseif ($pengajuan->status == 10)
                                <div class="bg-green-500 rounded-lg shadow-lg p-3 w-28">
                                    <p class="text-xs sm:text-base text-white">Diterima</p>
                                </div>
                            @else
                                <div class="bg-red-500 rounded-lg shadow-lg p-3 w-28">
                                    <p class="text-xs sm:text-base text-white">Ditolak</p>
                                </div>
                            @endif
                    </td>
                    <td class="text-center py-5">
                        <a href="{{ url('tracking-pengajuan/' . $pengajuan->id_pengajuan) }}">
                            <i class="fas fa-arrow-right text-black text-lg" ></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Filter Popup --}}
    <div id="popup" class="fixed inset-0 bg-opacity-50 backdrop-blur-md hidden flex items-center justify-center">
    <div class="bg-white w-full sm:w-3/4 p-6 sm:p-8 rounded-3xl shadow-xl max-w-lg mx-auto relative">
        <div class="absolute top-4 right-4">
            <button onclick="hidePopup()" aria-label="Close" class="text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <form action="{{ url('/pengajuan/list-pengajuan') }}" method="GET">
                <div class="flex flex-col sm:flex-row justify-start gap-8 sm:gap-12">
                    <!-- Left Section: Checkboxes -->
                    <div class="flex flex-col items-start gap-4 sm:w-1/2">
                        <p class="text-xl font-semibold text-gray-700">Filter</p>

                        <!-- Tipe Beasiswa Section -->
                        <p class="text-sm sm:text-base font-medium text-gray-600">Filter Berdasarkan:</p>
                        <div class="w-full">
                            <select name="nama_beasiswa" id="nama_beasiswa"
                                class="mt-2 block w-full rounded-full border border-gray-300 p-3 focus:border-orange-400 focus:ring-orange-300">
                                <option value="">Select Nama Beasiswa</option>
                                @foreach($namaBeasiswa as $beasiswa)
                                    <option value="{{ $beasiswa }}" {{ request('nama_beasiswa') == $beasiswa ? 'selected' : '' }}>
                                        {{ $beasiswa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <!-- Right Section: Dropdowns -->
                    <div class="flex flex-col items-start gap-4 sm:w-1/2 mt-12">


                        <!-- Jurusan Section -->
                        <p class="text-sm sm:text-base font-medium text-gray-600">Tanggal Pengajuan:</p>
                        <div class="w-full">
                            <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan"
                                class="block w-full rounded-full border border-gray-300 p-3 focus:border-orange-400 focus:ring-orange-300">
                        </div>
                    </div>
                </div>

                <!-- Buttons Section -->
                <div class="flex flex-row justify-between gap-4 mt-6">
                    <button type="submit"
                        class="w-1/2 bg-blue-500 p-3 text-white rounded-full shadow-md hover:bg-blue-600">Apply</button>
                    <button type="button" onclick="hidePopup()"
                        class="w-1/2 bg-red-500 p-3 text-white rounded-full shadow-md hover:bg-red-600">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection
