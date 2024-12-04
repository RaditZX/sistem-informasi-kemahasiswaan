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
                <div class="pl-10 pr-4 py-2 bg-orange-500 rounded shadow-lg p-2 w-auto cursor-pointer">
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
                            <div class="bg-orange-500 rounded-lg shadow-lg p-3 w-28">
                                <p class="text-xs sm:text-base text-white">{{ $pengajuan->isi_status }}</p>
                            </div>
                    </td>
                    <td class="text-center py-5">
                        <a href="{{ url('tracking-pengajuan') }}">
                            <i class="fas fa-arrow-right text-black text-lg" onclick=""></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>




@endsection
