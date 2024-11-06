@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')

@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null])

    <div class="flex flex-row p-5">
        <!-- Left Side: Swiper Image - Set to 50% width, centered content -->
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

        <!-- Right Side: Content Details -->
        <div class="basis-1/2 flex flex-col justify-start items-start p-5">
            <p class="text-2xl font-bold text-left">
                Beasiswa LKPD
            </p>
            <div class="flex flex-row gap-5 text-center mr-10 mt-3">
                <div class="border-2 border-orange-500 rounded-lg w-30 h-8 flex items-center justify-center">
                    <p class="text-sm font-bold text-orange-500">
                        Berlangsung
                    </p>
                </div>
                <div class="border-2 border-orange-500 rounded-lg w-30 h-8 flex items-center justify-center">
                    <p class="text-sm font-bold text-orange-500">
                        Prestasi
                    </p>
                </div>
            </div>

            <p class="text-sm font-normal text-black mt-5">
                Hai Sobat Beasiswa.ID! Program beasiswa ini ditawarkan oleh Badan Kepegawaian Negara (BKN)
                melalui beasiswa pendidikan Ilmu Kepegawaian Angkatan XVIII bekerjasama dengan Universitas Negeri Jakarta (UNJ).
                Beasiswa ini ditujukan bagi PNS di Tanah Air yang ingin melanjutkan studi jenjang S1 Program Studi Manajemen Konsentrasi
                Manajemen Sumber Daya Manusia (MSDM) di UNJ.
            </p>

            <div class="bg-orange-500 rounded-lg w-60 h-20 flex justify-center items-center mt-5 cursor-pointer">
                <p class="text-lg font-bold text-white text-center">
                    Daftar
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 100,
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
