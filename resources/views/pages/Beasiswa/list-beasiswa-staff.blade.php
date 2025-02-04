@extends('layouts.filter')
@extends('layouts.main')
@section('content')
    @include('component.navbar', [
        'path' => 'List Beasiswa',
        'id' => null
    ])
    <div class="p-2">
        <div class="flex flex-row-reverse p-5 gap-3">
            <div class="relative flex items-center">
                <i class="fas fa-search absolute left-3 text-gray-500"></i>
                <form method="GET" action="{{ route('beasiswa.list-beasiswa-staff') }}" class="w-full">
                    <input type="text" name="search" id="searchInput" placeholder="Cari Beasiswa"
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full"
                        value="{{ request('search') }}">
                </form>
            </div>
            <div class="relative flex items-center">
                <i class="fas fa-filter absolute left-3 text-white"></i>
                <div class="pl-10 pr-4 py-2 bg-orange-500 rounded shadow-lg p-2 w-auto cursor-pointer"
                    onclick="showPopup()">
                    <p class="text-xs sm:text-base text-white">Filter</p>
                </div>
            </div>
            <div class="relative flex items-center">
                <i class="fas fa-plus absolute left-3 text-white"></i>
                <a href={{ route('beasiswa.create') }}>
                    <div class="pl-10 pr-4 py-2 bg-orange-500 rounded shadow-lg p-2 w-auto cursor-pointer">
                        <p class="text-xs sm:text-base text-white">Tambah</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-none">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-center font-bold text-gray-700">Nama</th>
                        <th class="px-4 py-2 text-center font-bold text-gray-700">Penyelenggara</th>
                        <th class="px-4 py-2 text-center font-bold text-gray-700">Tanggal Mulai</th>
                        <th class="px-4 py-2 text-center font-bold text-gray-700">Tanggal Berakhir</th>
                        <th class="px-4 py-2 text-center font-bold text-gray-700">Action</th>
                        <th class="px-4 py-2 text-center font-bold text-gray-700">Status</th>
                        <th class="px-4 py-2 text-center font-bold text-gray-700"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beasiswa as $b)
                        <tr class="border-2 rounded-3xl">
                            <td class="text-center py-5">{{ $b->nama_beasiswa }}</td>
                            <td class="text-center py-5">{{ $b->sumber }}</td>
                            <td class="text-center py-5">{{ $b->tanggal_mulai }}</td>
                            <td class="text-center py-5">{{ $b->tanggal_berakhir }}</td>
                            <td class="text-center py-5 flex">
                                <div class="flex flex-row gap-2 justify-center items-center">
                                    <a href="{{ route('beasiswa.edit',['id' => $b->id]) }}">
                                        <div class="rounded-lg p-3 bg-orange-500 min-w-24">
                                            <div class="flex justify-center">
                                                <h4 class="font-medium text-base text-center text-white">Edit</h4>
                                            </div>
                                        </div>
                                    </a>
                                    <form action="{{ route('beasiswa.destroy', $b->id) }}" method="POST"
                                        class="flex items-center"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit">
                                            <div class="rounded-lg p-3 border border-red-500 min-w-24">
                                                <div class="flex gap-3">
                                                    <h4 class="font-medium text-base text-red-500">Delete</h4>
                                                    <div class="bg-red-500 rounded-xl inline-block p-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="white" class="bi bi-trash-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
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
                                            : 'Berakhir');
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
    {{-- Filter Popup --}}
    <div id="popup" class="fixed inset-0 bg-opacity-50 backdrop-blur-md hidden flex items-center justify-center">
        <div class="bg-white w-full sm:w-3/4 p-6 sm:p-8 rounded-3xl shadow-xl max-w-lg mx-auto relative">
            <div class="absolute top-4 right-4">
                <button onclick="hidePopup()" aria-label="Close" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4">

                <form action="{{ route('beasiswa.list-beasiswa-staff') }}" method="GET">
                    <div class="flex flex-col sm:flex-row justify-start gap-12 sm:gap-24">
                        <!-- Left Section: Checkboxes -->
                        <div class="flex flex-col items-start gap-6 sm:w-1/2">
                            <p class="text-xl font-semibold text-gray-700">Filter</p>

                            <!-- Jenis Beasiswa Section -->
                            <p class="text-sm sm:text-base font-medium text-gray-600">Jenis Beasiswa</p>
                            <div class="flex flex-row items-start gap-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="jenis_beasiswa[]" value="half"
                                        {{ in_array('half', request('jenis_beasiswa', [])) ? 'checked' : '' }}
                                        class="rounded-full border-gray-300 focus:ring-0 focus:ring-offset-0 text-orange-500 h-8 w-8" />
                                    <label for="half" class="ml-2 text-sm text-gray-600">Half</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="jenis_beasiswa[]" value="full"
                                        {{ in_array('full', request('jenis_beasiswa', [])) ? 'checked' : '' }}
                                        class="rounded-full border-gray-300 focus:ring-0 focus:ring-offset-0 text-orange-500 h-8 w-8" />
                                    <label for="full" class="ml-2 text-sm text-gray-600">Full</label>
                                </div>
                            </div>

                            <!-- Jenjang Pendidikan Section -->
                            <p class="text-sm sm:text-base font-medium text-gray-600">Jenjang Pendidikan</p>
                            <div class="flex flex-row items-start gap-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="jenjang_pendidikan[]" value="D3"
                                        {{ in_array('D3', request('jenjang_pendidikan', [])) ? 'checked' : '' }}
                                        class="rounded-full border-gray-300 focus:ring-0 focus:ring-offset-0 text-orange-500 h-8 w-8" />
                                    <label for="D3" class="ml-2 text-sm text-gray-600">D3</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="jenjang_pendidikan[]" value="D4"
                                        {{ in_array('D4', request('jenjang_pendidikan', [])) ? 'checked' : '' }}
                                        class="rounded-full border-gray-300 focus:ring-0 focus:ring-offset-0 text-orange-500 h-8 w-8" />
                                    <label for="D4" class="ml-2 text-sm text-gray-600">D4</label>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section: Dropdowns -->
                        <div class="flex flex-col items-start gap-6 sm:w-1/2 mt-6">
                            <!-- Tipe Beasiswa Section -->
                            <p class="text-sm sm:text-base font-medium text-gray-600">Tipe Beasiswa</p>
                            <div class="w-full">
                                <select name="tipe_beasiswa" id="tipe_beasiswa"
                                    class="mt-2 block w-full rounded-full border border-gray-300 p-3 focus:border-orange-400 focus:ring-orange-300">
                                    <option value="">Select Tipe Beasiswa</option>
                                    <option value="kipk" {{ request('tipe_beasiswa') == 'kipk' ? 'selected' : '' }}>KIPK
                                    </option>
                                    <option value="internal"
                                        {{ request('tipe_beasiswa') == 'internal' ? 'selected' : '' }}>Internal</option>
                                    <option value="eksternal"
                                        {{ request('tipe_beasiswa') == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                                </select>
                            </div>

                            <!-- Jurusan Section -->
                            <p class="text-sm sm:text-base font-medium text-gray-600">Jurusan Khusus:</p>
                            <div class="w-full">
                                <select name="jurusan" id="jurusan"
                                    class="block w-full rounded-full border border-gray-300 p-3 focus:border-orange-400 focus:ring-orange-300">
                                    <option value="">Pilih Jurusan</option>
                                    <option value="Teknik Informatika"
                                        {{ request('jurusan') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik
                                        Informatika</option>
                                    <option value="Teknik Sipil"
                                        {{ request('jurusan') == 'Teknik Sipil' ? 'selected' : '' }}>Teknik Sipil</option>
                                </select>
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
