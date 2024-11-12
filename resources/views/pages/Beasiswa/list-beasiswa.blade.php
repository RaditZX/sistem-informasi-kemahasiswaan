@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')
@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null])

    {{-- Filter Button and Search Column --}}
    <div class="p-2">
        <div class="flex flex-auto justify-center">
            <div class="flex flex-col items-end p-2">
                <div class="bg-white rounded shadow-lg p-5 w-fit cursor-pointer" onclick="showPopup()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-sliders2-vertical" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M0 10.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H3V1.5a.5.5 0 0 0-1 0V10H.5a.5.5 0 0 0-.5.5M2.5 12a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5m3-6.5A.5.5 0 0 0 6 6h1.5v8.5a.5.5 0 0 0 1 0V6H10a.5.5 0 0 0 0-1H6a.5.5 0 0 0-.5.5M8 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2A.5.5 0 0 0 8 1m3 9.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H14V1.5a.5.5 0 0 0-1 0V10h-1.5a.5.5 0 0 0-.5.5m2.5 1.5a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5" />
                    </svg>
                </div>
            </div>
            <div class="basis-3/4 flex rounded p-5">
                <form method="GET" action="{{ route('beasiswa.index') }}" class="w-full">
                    <input type="text" name="search" id="searchInput" placeholder="Cari Beasiswa"
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full"
                           value="{{ request('search') }}">
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1 p-5">

        @foreach ($beasiswa as $ba)
        <a href="/beasiswa/{{ $ba->id }}" data-nama-beasiswa="{{ $ba->nama_beasiswa }}" class="beasiswa-card">
            <div class="p-2">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEik4McHhDC2otgAFVVxX1_9KI4xqY0KLdkThGiFYjsfN720_z_kIvi2TARm24mA68XO1CbMBSILOHFfy0HIQVO9Hn1qXFxSVfTC54ZaoHKLi6Yj-fd6Lm02syaeQ_Q3nkaGu4LpM6JSk-MwEEzzYqjZMbMNDyQiP8InBNz7sFn00DMJXQQBakiNtx8qBw/s1080/Beasiswa-Creativa-Feed.png"
                    style="border-radius: 15px;" class="mb-3 h-400" alt="beasiswa">
                <div class="flex justify-center gap-2 mb-1" style="max-height: 35px">
                    <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D3</div>
                    <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D4</div>
                    <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">FULL</div>
                </div>
                <p class="font-bold text-justify mb-1">{{ $ba->nama_beasiswa }}</p>
                <p class="text-xs text-justify mb-2">"{{ $ba->deskripsi }}</p>
                <div class="flex flex-auto justify-left gap-3">
                    <img src="https://th.bing.com/th?id=OIP.InKvUSEGq1ZVmF1-PiX8YQAAAA&w=250&h=250&c=8&rs=1&qlt=90&o=6&cb=13&pid=3.1&rm=2"
                        class="w-5 h-5 rounded-full" alt="KEMENDIKBUD">
                    <p class="text-xs font-bold ">{{ $ba->sumber }}</p>
                </div>
            </div>
        </a>
        @endforeach

        {{-- Filter Popup --}}
        <div id="popup" class="fixed inset-0 basis-2/3 bg-opacity-50 backdrop-blur-md hidden flex items-center justify-center">
            <div class="bg-white w-full sm:w-2/3 p-4 sm:p-6 rounded-lg shadow-lg max-w-lg mx-auto relative">
                <div class="absolute top-2 right-2">
                    <button onclick="hidePopup()" aria-label="Close" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-3">
             
                        <div class="flex flex-col sm:flex-row justify-left gap-10 sm:gap-20">
                            <div class="flex flex-col items-start gap-3">
                                <p class="text-lg font-bold">Filter</p>

                                <!-- Tipe Beasiswa Section -->
                                <p class="text-sm sm:text-base font-bold">Jenis Beasiswa</p>
                                <form action="{{ url('/beasiswa') }}" method="GET">
                                    <div class="flex flex-row items-start gap-4 mb-4">
                                        <div class="flex flex-col items-center">
                                            <input type="checkbox" name="jenis_beasiswa[]" value="half" {{ in_array('half', request('jenis_beasiswa', [])) ? 'checked' : '' }} />
                                            <label for="half" class="text-xs sm:text-basic">Half</label>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <input type="checkbox" name="jenis_beasiswa[]" value="full" {{ in_array('full', request('jenis_beasiswa', [])) ? 'checked' : '' }} />
                                            <label for="full" class="text-xs sm:text-basic">Full</label>
                                        </div>
                                    </div>

                            </div>

                            <div class="flex flex-col items-start gap-3">
                                <p class="text-transparent">a</p>
                                <p class="text-sm sm:text-base font-bold">Tipe Beasiswa</p>
                                <div class="flex flex-col items-center">
                                    <select name="tipe_beasiswa" id="tipe_beasiswa" class="mt-1 block w-full rounded-md border border-orange-500 p-2 focus:border-orange-500 focus:ring-orange-500">
                                        <option value="">Select Tipe Beasiswa</option>
                                        <option value="kipk">KIPK</option>
                                        <option value="internal">Internal</option>
                                        <option value="eksternal">Eksternal</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row justify-between gap-3 mt-4">
                            <button type="submit" class="w-1/2 bg-blue-500 p-2 text-white rounded-lg shadow-lg hover:bg-blue-600">Apply</button>
                            <button type="button" onclick="hidePopup()" class="w-1/2 bg-red-500 p-2 text-white rounded-lg shadow-lg hover:bg-red-600">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
