@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')
@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null])

    <div class="flex flex-row p-5">
        <div class="flex justify-center items-center basis-1/2">
            <!-- Swiper -->
            <div class="swiper-container w-full max-w-lg">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/kipk.png') }}" class="w-full h-auto rounded-lg" alt="kipk">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/kipk2.png') }}" class="w-full h-auto rounded-lg" alt="kipk2">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/img/kipk3.png') }}" class="w-full h-auto rounded-lg" alt="kipk3">
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <!-- End Swiper -->
        </div>
    </div>

    <script>
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,   // Only show one slide at a time
            spaceBetween: 10,    // Space between slides
            pagination: {
                el: '.swiper-pagination',
                clickable: true, // Allow pagination dots to be clickable
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            loop: true, // Enable loop mode to allow continuous scrolling
        });
    </script>
   
@endsection
