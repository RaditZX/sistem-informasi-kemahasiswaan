@extends('layouts.filter')
@extends('layouts.main')
@section('content')
    @include('component.navbar', [
        'path' => 'List Beasiswa',
        'id' => null,
        'notificationData' => $notificationData,
    ])



    <div class="p-3 mt-10">
        <div class="flex flex-col lg:flex-row">
            <div class="flex flex-col gap-3 mt-16 lg:basis-1/2">
                <p class="text-2xl lg:text-3xl font-bold text-black">Pengumuman {{ $beasiswa->nama_beasiswa }}</p>
                <p class="text-xs lg:text-sm font-normal text-gray-500">
                    Berikut merupakan daftar mahasiswa penerima {{ $beasiswa->nama_beasiswa }}. Selamat dan
                    semangat untuk seluruh mahasiswa!
                </p>
                <div class="flex flex-col md:flex-row gap-2 mt-5">
                    <div class="text-center bg-orange-500 rounded-lg shadow-lg p-2 basis-1/2">
                        <p class="text-white">Download PDF</p>
                    </div>

                </div>
            </div>
            <div class="flex justify-center lg:basis-1/2 mt-5 lg:mt-0">
                <img src="{{ asset('assets/img/penerima.png') }}" class="w-full max-w-sm lg:max-h-80 rounded-lg"
                    alt="beasiswa">
            </div>
        </div>
        <div class="flex space-x-4 items-center justify-center mt-10">
            <button class="text-xl">&#8592;</button>
            @foreach ($penerima_beasiswa as $pb)
                <div class="flex space-x-4 overflow-x-auto">
                    <div class="w-40 md:w-48 bg-white rounded-lg drop-shadow-sm shadow-lg p-4 text-center m-5">
                        <div class="w-20 md:w-24 h-20 md:h-24 bg-gray-200 rounded-full mx-auto mb-2"></div>
                        <h3 class="text-blue-600 font-semibold">{{ $pb->nama_depan . $pb->nama_belakang }}</h3>
                        <p class="text-xs md:text-sm text-gray-600">{{ $pb->nama_jurusan }}</p>
                        <p class="text-xs text-gray-500">{{ $pb->nama_prodi }}</p>
                    </div>
                </div>
            @endforeach
            <button class="text-xl">&#8594;</button>
        </div>

        <div class="overflow-x-auto">
            <embed src="{{ $pdfUrl }}" width="100%" height="600px" type="application/pdf">

        </div>
    </div>
@endsection
