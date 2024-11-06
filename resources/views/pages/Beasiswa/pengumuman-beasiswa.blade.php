@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')
@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null])

    <div class="p-3 mt-10">
        <div class="flex flex-col lg:flex-row">
            <div class="flex flex-col gap-3 mt-16 lg:basis-1/2">
                <p class="text-2xl lg:text-3xl font-bold text-black">Pengumuman Beasiswa Kartu Indonesia Pintar - Kuliah</p>
                <p class="text-xs lg:text-sm font-normal text-gray-500">
                    Berikut merupakan daftar mahasiswa penerima beasiswa Kartu Indonesia Pintar - Kuliah. Selamat dan semangat untuk seluruh mahasiswa!
                </p>
                <div class="flex flex-col md:flex-row gap-2 mt-5">
                    <div class="text-center bg-orange-500 rounded-lg shadow-lg p-2 basis-1/2">
                        <p class="text-white">Download PDF</p>
                    </div>
                    <div class="border border-orange-500 rounded-lg text-center p-2 basis-1/2">
                        <p class="text-orange-500">Konfirmasi Penerimaan</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center lg:basis-1/2 mt-5 lg:mt-0">
                <img src="{{asset('assets/img/penerima.png')}}" class="w-full max-w-sm lg:max-h-80 rounded-lg" alt="beasiswa">
            </div>
        </div>

        <div class="flex space-x-4 items-center justify-center mt-10">
            <button class="text-xl">&#8592;</button>
            <div class="flex space-x-4 overflow-x-auto">
                <div class="w-40 md:w-48 bg-white rounded-lg drop-shadow-sm shadow-lg p-4 text-center m-5">
                    <div class="w-20 md:w-24 h-20 md:h-24 bg-gray-200 rounded-full mx-auto mb-2"></div>
                    <h3 class="text-blue-600 font-semibold">Daffa Al Ghifari</h3>
                    <p class="text-xs md:text-sm text-gray-600">Teknik Komputer dan Informatika</p>
                    <p class="text-xs text-gray-500">D3-Teknik Informatika</p>
                </div>
            </div>
            <button class="text-xl">&#8594;</button>
        </div>

        <div class="overflow-x-auto">
            <iframe src ="{{ asset('/laraview/pdf/cek.pdf') }}" width="1000px" height="1000px" class="mt-5 mx-auto w-full max-w-4xl " frameborder="0"></iframe>
        </div> 
    </div>
@endsection
