@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')
@section('content')

@include('component.navbar', [
    'path' => "Madding",
    'id' => null
])

<div class="madding-wrapper mx-auto py-6 sm:px-6 lg:px-10">
    <div class="madding-1">
        <div class="madding-header pb-4 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Madding Beasiswa</h1>
                <p>Tempat kamu mendapatkan info terbaru mengenai beasiswa :D</p>
            </div>
            <div>
                <a href="#" type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Lihat Lebih Banyak
                </a>
            </div>
        </div>
        <div class="madding-content">
            <div class="madding-content-1">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-black-600 bg-yellow-300 hover:text-black-600 dark:text-black-500 dark:hover:text-yellow-500 border-yellow-600 dark:border-yellow-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-black-600 dark:text-gray-400 border-black-100 hover:border-black-300 dark:border-black-700 dark:hover:text-gray-300" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="newest-styled-tab" data-tabs-target="#styled-newest" type="button" role="tab" aria-controls="newest" aria-selected="false">Terbaru</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="upcoming-styled-tab" data-tabs-target="#styled-upcoming" type="button" role="tab" aria-controls="upcoming" aria-selected="false">Upcoming</button>
                        </li>
                    </ul>
                </div>
                <div id="default-styled-tab-content">
                    <div class="hidden p-4 rounded-lg bg-gray-100 rounded-xl grid grid-rows-[auto 1fr 1fr 1fr] grid-cols-4 gap-4" id="styled-newest" role="tabpanel" aria-labelledby="newest-tab">
                        @foreach ($newestBeasiswa as $index => $beasiswa)
                            @if ($index === 0)
                                <div class="row-span-2 col-span-2 flex flex-col rounded-2xl h-full">
                                    <div class="flex-1 flex flex-col bg-white border-2 border-gray-600 rounded-lg shadow ">
                                        <div class="flex flex-col h-full md:flex-row items-stretch rounded-lg hover:bg-[#fffdf4]">
                                            <!-- Image section -->
                                            <img class="w-full md:w-1/2 object-cover rounded-t-lg md:rounded-none md:rounded-l-lg" 
                                                src="https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/poster%2FPoster-Beasiswa-Prestasi-Kita-4.jpg?alt=media&token=e80d5dad-456e-4fc5-bf19-16cbf4365244" 
                                                alt="">
                                            
                                            <!-- Content section -->
                                            <div class="flex flex-col justify-between p-6 leading-normal">
                                                <div class="mb-4">
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $beasiswa->tipe_beasiswa }}</span>
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ $beasiswa->jenis_beasiswa }}</span>
                                                </div>
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                                    {{ $beasiswa->nama_beasiswa }}
                                                </h5>
                                                <div class="">
                                                    <span class="bg-yellow-500 text-gray-900 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border border-yellow-500 ">
                                                        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                                        </svg>
                                                        {{ $beasiswa->tanggal_mulai }} - {{ $beasiswa->tanggal_berakhir }}
                                                    </span>
                                                </div>
                                                <p class="mb-4 text-sm font-normal text-gray-900">
                                                    {{ $beasiswa->short_description }}
                                                </p>
                                                <a 
                                                    href="#" 
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-700 mt-4"
                                                >
                                                    Lihat Selengkapnya
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                                                             
                            @else
                            <div class="row-span-2 bg-yellow-700 flex flex-col rounded-2xl">
                                <div class="flex-1 bg-white border-2 border-gray-600 rounded-lg shadow flex flex-col hover:bg-[#fffdf4]">
                                    
                                    <!-- Image Section -->
                                    <a href="#" class="rounded-t-lg overflow-hidden">
                                        <img 
                                            class="h-48 w-full object-cover" 
                                            src="https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/poster%2FPoster-Beasiswa-Prestasi-Kita-4.jpg?alt=media&token=e80d5dad-456e-4fc5-bf19-16cbf4365244" 
                                            alt="Poster Beasiswa"
                                        />
                                    </a>
                            
                                    <!-- Content Section -->
                                    <div class="p-5 flex-1 flex flex-col justify-between">
                                        
                                        <!-- Badge Row -->
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                                {{ $beasiswa->tipe_beasiswa }}
                                            </span>
                                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                {{ $beasiswa->jenis_beasiswa }}
                                            </span>
                                        </div>
                            
                                        <!-- Title -->
                                        <h1 class="mb-4">
                                            <h5 class="text-2xl font-bold tracking-tight text-gray-900 h-16 flex">
                                                {{ $beasiswa->nama_beasiswa }}
                                            </h5>
                                        </h1>
                                        
                                        <div class="mt-4">
                                            <span class="bg-yellow-500 text-gray-900 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border border-yellow-500 ">
                                                <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                                </svg>
                                                {{ $beasiswa->tanggal_mulai }} - {{ $beasiswa->tanggal_berakhir }}
                                            </span>
                                        </div>
                            
                                        <!-- Description -->
                                        <p class="flex-grow font-normal text-gray-900  mt-4">
                                            {{ $beasiswa->short_description }}
                                        </p>
                            
                                        <!-- Button -->
                                        <a 
                                            href="#" 
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-700 mt-4"
                                        >
                                            Lihat Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>                            
                            @endif
                        @endforeach
                    </div>
                    
                    <div class="hidden p-4 rounded-lg bg-gray-100 rounded-xl grid grid-rows-[auto 1fr 1fr 1fr] grid-cols-4 gap-4" id="styled-upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                        @foreach ($upcomingBeasiswa as $index => $beasiswa)
                            @if ($index === 0)
                                <div class="row-span-2 col-span-2 flex flex-col rounded-2xl h-full">
                                    <div class="flex-1 flex flex-col bg-white border-2 border-gray-600 rounded-lg shadow ">
                                        <div class="flex flex-col h-full md:flex-row items-stretch rounded-lg hover:bg-[#fffdf4]">
                                            <!-- Image section -->
                                            <img class="w-full md:w-1/2 object-cover rounded-t-lg md:rounded-none md:rounded-l-lg" 
                                                src="https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/poster%2FPoster-Beasiswa-Prestasi-Kita-4.jpg?alt=media&token=e80d5dad-456e-4fc5-bf19-16cbf4365244" 
                                                alt="">
                                            
                                            <!-- Content section -->
                                            <div class="flex flex-col justify-between p-6 leading-normal">
                                                <div class="mb-4">
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $beasiswa->tipe_beasiswa }}</span>
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ $beasiswa->jenis_beasiswa }}</span>
                                                </div>
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                                    {{ $beasiswa->nama_beasiswa }}
                                                </h5>
                                                <div class="">
                                                    <span class="bg-yellow-500 text-gray-900 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border border-yellow-500 ">
                                                        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                                        </svg>
                                                        {{ $beasiswa->tanggal_mulai }} - {{ $beasiswa->tanggal_berakhir }}
                                                    </span>
                                                </div>
                                                <p class="mb-4 text-sm font-normal text-gray-900">
                                                    {{ $beasiswa->short_description }}
                                                </p>
                                                <a 
                                                    href="#" 
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-700 mt-4"
                                                >
                                                    Lihat Selengkapnya
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                                                             
                            @else
                            <div class="row-span-2 bg-yellow-700 flex flex-col rounded-2xl">
                                <div class="flex-1 bg-white border-2 border-gray-600 rounded-lg shadow flex flex-col hover:bg-[#fffdf4]">
                                    
                                    <!-- Image Section -->
                                    <a href="#" class="rounded-t-lg overflow-hidden">
                                        <img 
                                            class="h-48 w-full object-cover" 
                                            src="https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/poster%2FPoster-Beasiswa-Prestasi-Kita-4.jpg?alt=media&token=e80d5dad-456e-4fc5-bf19-16cbf4365244" 
                                            alt="Poster Beasiswa"
                                        />
                                    </a>
                            
                                    <!-- Content Section -->
                                    <div class="p-5 flex-1 flex flex-col justify-between">
                                        
                                        <!-- Badge Row -->
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                                {{ $beasiswa->tipe_beasiswa }}
                                            </span>
                                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                {{ $beasiswa->jenis_beasiswa }}
                                            </span>
                                        </div>
                            
                                        <!-- Title -->
                                        <h1 class="mb-4">
                                            <h5 class="text-2xl font-bold tracking-tight text-gray-900 h-16 flex">
                                                {{ $beasiswa->nama_beasiswa }}
                                            </h5>
                                        </h1>
                                        
                                        <div class="mt-4">
                                            <span class="bg-yellow-500 text-gray-900 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border border-yellow-500 ">
                                                <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                                </svg>
                                                {{ $beasiswa->tanggal_mulai }} - {{ $beasiswa->tanggal_berakhir }}
                                            </span>
                                        </div>
                            
                                        <!-- Description -->
                                        <p class="flex-grow font-normal text-gray-900  mt-4">
                                            {{ $beasiswa->short_description }}
                                        </p>
                            
                                        <!-- Button -->
                                        <a 
                                            href="#" 
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-700 mt-4"
                                        >
                                            Lihat Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>                            
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="madding-content-2"></div>
        </div>
    </div>

    <div class="madding-2 mt-[3em]">
        <div class="madding-header pb-4">
            <h1 class="text-2xl font-bold">Mereka Bisa, Kamu Juga Bisa!</h1>
            <p>Beberapa mahasiswa yang berhasil mendapatkan beasiswa bulan ini :D</p>
        </div>
        <div class="madding-content grid grid-cols-4 gap-4">
            @foreach ($newestMahasiswaAccepted as $penerima)
                <div class="w-full max-w-sm bg-white border-2 border-gray-900 rounded-lg shadow-xl">
                    <div class="flex flex-col items-center p-10">
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg mb-5" src="https://s1.zerochan.net/Mudrock.600.3200855.jpg" alt="Bonnie image"/>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 text-center">{{ $penerima->nama_depan }} {{ $penerima->nama_belakang }}</h5>
                        <span class="text-sm text-gray-500">{{ $penerima->nama_prodi }} @ {{ $penerima->angkatan }}</span>
                        <div class="flex mt-2 md:mt-4 flex flex-col gap-1 justify-center items-center text-center">
                            <p class="text-gray-900">Penerima Beasiswa</p>
                            <h1 class="text-gray-900 font-bold">{{ $penerima->nama_beasiswa }}</h1>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="py-5">
            {{ $newestMahasiswaAccepted->links() }}
        </div>
    </div>
</div>

@endsection