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
            $status = $isReceived['status'];
        }
        if ($isAnyBeasiswaReceived && !($ba->status == 'half' && $ba->tanggal_berakhir > $currentDate && $ba->tanggal_berakhir <= $oneYearLater)) {
            $status = 'Closed';
        }
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
            <p class="text-xs text-justify mb-2">
                {{ implode(' ', array_slice(explode(' ', $ba->deskripsi), 0, 30)) }}{{ str_word_count($ba->deskripsi) > 30 ? '...' : '' }}
            </p>

            <div class="flex flex-auto justify-left gap-3">
                <img src="{{ $ba->sumber_logo ? $ba->sumber_logo : 'https://example.com/default-logo.jpg' }}"
                    class="w-5 h-5 rounded-full" alt="{{ $ba->sumber }}">
                <p class="text-xs font-bold">{{ $ba->sumber }}</p>
            </div>
        </div>
    </a>
    @endforeach





    </div>


@endsection
