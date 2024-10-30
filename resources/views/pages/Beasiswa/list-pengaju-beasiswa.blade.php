@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')
@section('content')
    @include('component.navbar', ['path' => 'List Pengaju Beasiswa', 'id' => null])


    
    {{-- Filter, Tanngal Button dan Kolom Pencarian --}}
    <div class="p-2">
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
                <tr class="border-2 rounded-3xl">
                    <td class="text-center py-5">Raihan Pratama</td>
                    <td class="text-center py-5">Beasiswa LKPD</td>
                    <td class="text-center py-5">KEMENDIKBUD</td>
                    <td class="text-center py-5">12-10-2024</td>
                    <td class="text-center">
                        <div class="border border-gray-300 rounded-lg shadow-lg p-3 ml-10 mr-10 ">
                            <p class="text-xs sm:text-base text-black">Belum di validasi</p>
                        </div>
                    </td>
                    <td>
                        <a href="{{ url('tracking-pengajuan') }}">
                            <i class="fas fa-arrow-right text-black text-lg" onclick=""></i>     
                        </a> 
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
        

    

@endsection
