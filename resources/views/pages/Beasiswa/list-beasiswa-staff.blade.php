@extends('layouts.filter')
@extends('layouts.main')
@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null, 'notificationData'=>$notificationData])



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
            <div class="relative flex items-center">
                <i class="fas fa-plus absolute left-3 text-white"></i>
                <a href="/beasiswa/create">
                    <div class="pl-10 pr-4 py-2 bg-orange-500 rounded shadow-lg p-2 w-auto cursor-pointer">
                        <p class="text-xs sm:text-base text-white">Tambah</p>
                    </div>
                 </a>
            </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full table-fixed border border-none" >
            <thead>
                <tr>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Nama</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Penyelenggara</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Tanggal Mulai</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Tanggal Berakhir</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Action</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700">Status</th>
                    <th class="w-1/6 px-4 py-2 text-center font-bold text-gray-700"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($beasiswa as $b )


                <tr class="border-2 rounded-3xl">
                    <td class="text-center py-5">{{ $b->nama_beasiswa }}</td>
                    <td class="text-center py-5">{{ $b->sumber }}</td>
                    <td class="text-center py-5">{{ $b->tanggal_mulai }}</td>
                    <td class="text-center py-5">{{ $b->tanggal_berakhir }}</td>
                    <td class="text-center py-5 flex">
                        <div class="flex flex-row gap-2 justify-center items-center">
                            <a href="/beasiswa/{{ $b->id }}/edit">
                                <div class="rounded-lg p-3 bg-orange-500 min-w-24">
                                    <div class="flex justify-center">
                                        <h4 class="font-medium text-base text-center text-white">Edit</h4>
                                    </div>
                                </div>
                            </a>
                            <form action="{{ route('beasiswa.destroy', $b->id) }}" method="POST" class="flex items-center" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" >
                                    <div class="rounded-lg p-3 border border-red-500 min-w-24">
                                        <div class="flex gap-3">
                                            <h4 class="font-medium text-base text-red-500">Delete</h4>
                                            <div class="bg-red-500 rounded-xl inline-block p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </td>
                    @php
                    $status =
                        $b->tanggal_mulai <= now() && $b->tanggal_berakhir >= now()
                            ? 'Berlangsung'
                            : ($b->tanggal_mulai > now()
                                ? 'Upcoming'
                                : 'Past');
                    @endphp
                    <td class="text-center">
                        <div class="border border-gray-300 rounded-lg shadow-lg p-3 ml-10 mr-10 ">
                            <p class="text-xs sm:text-base text-black">{{ $status }}</p>
                        </div>
                    </td>
                    <td>
                        <a href="/beasiswa/{{ $b->id }}">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <div class="p-5">
        {{ $beasiswa->links() }}
    </div>




@endsection
