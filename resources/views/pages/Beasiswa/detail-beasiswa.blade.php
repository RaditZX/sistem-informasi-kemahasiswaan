@extends('layouts.main')
@section('content')
    @include('component.navbar',['path'=>"Detail Beasiswa",'id'=>$id, 'notificationData'=>$notificationData])
    
    <div class="p-4">
    <!-- Main Section: Poster and Scholarship Info -->
    <div class="flex flex-col lg:flex-row gap-4">
        <!-- Poster Section (50%) -->
        <div class="basis-1/2 flex justify-center items-center overflow-hidden relative"> <!-- Centering Swiper -->
            <div class="swiper-container w-3/4 h-56">
                <div class="swiper-wrapper">
                    <div class="swiper-slide flex justify-center ">
                        <img src="{{ asset('assets/img/kipk.png') }}" class="w-auto h-full object-contain rounded-lg" alt="kipk">
                    </div>
                    <div class="swiper-slide flex justify-center">
                        <img src="{{ asset('assets/img/kipk.png') }}" class="w-auto h-full object-contain rounded-lg" alt="kipk2">
                    </div>
                    <div class="swiper-slide flex justify-center">
                        <img src="{{ asset('assets/img/kipk.png') }}" class="w-auto h-full object-contain rounded-lg" alt="kipk3">
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <!-- Position navigation buttons inside the swiper-container -->
                <div class="swiper-button-next absolute right-20"></div>
                <div class="swiper-button-prev absolute left-20"></div>
            </div>
        </div>

        <!-- Description Section (50%) -->
        <div class="lg:basis-1/2">
            <h1 class="text-xl lg:text-2xl font-semibold">{{ $beasiswa->nama_beasiswa }}</h1>
            <div class="flex flex-wrap gap-2 my-2">
                <span class="border rounded-full px-3 py-1 text-orange-500 bg-white text-sm">
                    {{ $beasiswa->tipe_beasiswa }}
                </span>
                <span class="border rounded-full px-3 py-1 text-orange-500 bg-white text-sm">
                    {{ $beasiswa->jenis_waktu_beasiswa }}
                </span>
            </div>
            <p class="text-sm text-gray-700">{{ $beasiswa->deskripsi }}</p>
            <a href="/pengajuan-beasiswa/{{ $id }}" class="mt-4 inline-flex items-center bg-yellow-400 px-4 py-2 rounded-lg shadow">
                <span class="text-black font-medium">Apply Now</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="ml-2">
                <path fill-rule="evenodd"
                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Benefits Section -->
<div class="mt-4">
    <h2 class="text-lg font-semibold text-yellow-400">Benefits</h2>
    <div class="h-1 w-6 bg-orange-500 rounded-lg mb-2"></div>
    
    <!-- Slider or Benefit Content -->
    <div class="text-sm text-gray-700 w-auto m-10">
        @include('component.slider', ['beasiswa' => $beasiswa], ['isBenefit' => true])
    </div>
</div>


    <!-- Syarat and Syarat Dokumen Section -->
<div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Syarat Section -->
    <div class="bg-gray-100 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-yellow-400">Syarat</h2>
        <div class="h-1 w-8 bg-orange-500 rounded-lg mb-4"></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($beasiswa->syaratBeasiswa as $syarat)
                <div class="p-3 bg-white rounded-lg shadow-sm">
                    <p class="text-sm text-gray-600 font-semibold">{{ $syarat->syarat }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Syarat Dokumen Section -->
    <div class="bg-gray-100 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-yellow-400">Syarat Dokumen</h2>
        <div class="h-1 w-8 bg-orange-500 rounded-lg mb-4"></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($beasiswa->syaratDokumen as $syarat)
                <div class="p-3 bg-white rounded-lg shadow-sm">
                    <h3 class="text-sm font-semibold">{{ $syarat->dokumen }}</h3>
                    <p class="text-xs text-gray-600 font-semibold">{{ $syarat->deskripsi_dokumen }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop: true,
        });
    });
</script>


@endsection
