@extends('layouts.filter')
@extends('layouts.main')
@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null,'notificationData'=>$notificationData])

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
    @php
        // Cek apakah ada beasiswa yang sudah diterima
        $isAnyBeasiswaReceived = count($beasiswaUserTipe) > 0; // Jika sudah ada yang diterima
        $currentDate = now(); // Ambil tanggal sekarang
        $oneYearLater = now()->addYear(); // Tanggal satu tahun dari sekarang
    @endphp

    @foreach ($beasiswa as $ba)
    @php
        // Default status
        $status = ($ba->tanggal_mulai <= $currentDate && $ba->tanggal_berakhir >= $currentDate) 
            ? "Berlangsung"
            : ($ba->tanggal_mulai > $currentDate
                ? "Upcoming"
                : "Past");

        // Cek apakah beasiswa sudah diterima
        $isReceived = collect($beasiswaUserTipe)->firstWhere('id', $ba->id);

        if ($isReceived) {
            // Jika sudah diterima, set status dari data controller
            $status = $isReceived['status']; 
        }

        // Jika sudah ada beasiswa yang diterima, set status semua beasiswa menjadi Closed, kecuali untuk yang 'half' dan masih berlaku
        if ($isAnyBeasiswaReceived && !($ba->status == 'half' && $ba->tanggal_berakhir > $currentDate && $ba->tanggal_berakhir <= $oneYearLater)) {
            $status = 'Closed';
        }

        // Jika beasiswa sudah diterima, tidak bisa didaftar lagi
        $canRegister = !$isAnyBeasiswaReceived || ($ba->status == 'half' && $ba->tanggal_berakhir > $currentDate && $ba->tanggal_berakhir <= $oneYearLater); // jika ada yang diterima, tidak bisa daftar lagi kecuali yang 'half' dalam rentang satu tahun ke depan

    @endphp

            @if($ba->tipe_beasiswa === "kipk")
                <a href="{{ $canRegister && $status !== 'Closed' && $status !== 'Closed Permanently' ? '/detail-beasiswa-kipk/'.$ba->id : '#' }}" 
                    class="beasiswa-card {{ $status === 'Closed' || $status === 'Closed Permanently' ? 'disabled' : '' }}" 
                    data-nama-beasiswa="{{ $ba->nama_beasiswa }}">
            @elseif($ba->tipe_beasiswa === "eksternal")
                <a href="{{ $canRegister && $status !== 'Closed' && $status !== 'Closed Permanently' ? '/detail-beasiswa-eksternal/'.$ba->id : '#' }}" 
                    class="beasiswa-card {{ $status === 'Closed' || $status === 'Closed Permanently' ? 'disabled' : '' }}" 
                    data-nama-beasiswa="{{ $ba->nama_beasiswa }}">
            @else
                <a href="{{ $canRegister && $status !== 'Closed' && $status !== 'Closed Permanently' ? '/beasiswa/'.$ba->id : '#' }}" 
                    class="beasiswa-card {{ $status === 'Closed' || $status === 'Closed Permanently' ? 'disabled' : '' }}" 
                    data-nama-beasiswa="{{ $ba->nama_beasiswa }}">
            @endif
                <div class="p-2 relative">
            @if($status !== 'Berlangsung')
                <div class="absolute inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center rounded-lg">
                    <div class="w-max border border-white rounded-xl p-2 px-5">
                        <p class="text-white font-bold text-xl">{{ $status }}</p>
                    </div>
                </div>
                @endif
                <img src={{ $ba->link_poster ? $ba->link_poster :"https://th.bing.com/th?id=OIP.ZZHzMoUorhjfqzXJHS80XQHaJQ&w=223&h=279&c=8&rs=1&qlt=90&o=6&dpr=1.4&pid=3.1&rm=2" }}
                    style="border-radius: 15px;" class="mb-3 h-400" width="100%" height="100%" alt="beasiswa">
                <div class="flex justify-center gap-2 mb-1" style="max-height: 35px">
                    <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">{{ $ba->jenis_beasiswa }}</div>
                    <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">Kuota: {{ $ba->kuota }}</div>
                    <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">{{ $ba->kuota }}</div>
                </div>
                <p class="font-bold text-justify mb-1">{{ $ba->nama_beasiswa }}</p>
                <p class="text-xs text-justify mb-2">
                    {{ \Illuminate\Support\Str::limit($ba->deskripsi, 300, '...') }}
                </p>
                <div class="flex flex-auto justify-left gap-3">
                    <img src={{ $ba->link_poster ? $ba->link_poster :"https://th.bing.com/th?id=OIP.InKvUSEGq1ZVmF1-PiX8YQAAAA&w=250&h=250&c=8&rs=1&qlt=90&o=6&cb=13&pid=3.1&rm=2" }}
                        class="w-5 h-5 rounded-full" alt="KEMENDIKBUD">
                    <p class="text-xs font-bold ">{{ $ba->sumber }}</p>
            </div>
            <p class="font-bold text-justify mb-1">{{ $ba->nama_beasiswa }}</p>
            <p class="text-xs text-justify mb-2">{{ $ba->deskripsi }}</p>
            <div class="flex flex-auto justify-left gap-3">
                <img src="{{ $ba->sumber_logo ? $ba->sumber_logo : 'https://example.com/default-logo.jpg' }}" 
                    class="w-5 h-5 rounded-full" alt="{{ $ba->sumber }}">
                <p class="text-xs font-bold">{{ $ba->sumber }}</p>
            </div>
        </div>
    </a>
    @endforeach

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
                    <form action="{{ url('/beasiswa') }}" method="GET">
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
                                        <option value="kipk" {{ request('tipe_beasiswa') == 'kipk' ? 'selected' : '' }}>KIPK</option>
                                        <option value="internal" {{ request('tipe_beasiswa') == 'internal' ? 'selected' : '' }}>Internal</option>
                                        <option value="eksternal" {{ request('tipe_beasiswa') == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                                    </select>
                                </div>

                                <!-- Jurusan Section -->
                                <p class="text-sm sm:text-base font-medium text-gray-600">Jurusan Khusus:</p>
                                <div class="w-full">
                                    <select name="jurusan" id="jurusan"
                                        class="block w-full rounded-full border border-gray-300 p-3 focus:border-orange-400 focus:ring-orange-300">
                                        <option value="">Pilih Jurusan</option>
                                        <option value="Teknik Informatika" {{ request('jurusan') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                        <option value="Teknik Sipil" {{ request('jurusan') == 'Teknik Sipil' ? 'selected' : '' }}>Teknik Sipil</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons Section -->
                        <div class="flex flex-row justify-between gap-4 mt-6">
                            <button type="submit"
                                class="w-1/2 bg-orange-500 p-3 text-white rounded-full shadow-md hover:bg-blue-600">Apply</button>
                            <button type="button" onclick="hidePopup()"
                                class="w-1/2 bg-red-500 p-3 text-white rounded-full shadow-md hover:bg-red-600">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
@endsection