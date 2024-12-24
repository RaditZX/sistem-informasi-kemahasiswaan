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
                <a class="button" href="#">Lihat Lebih Banyak...</a>
            </div>
        </div>
        <div class="madding-content">
            <div class="madding-content-1">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-black-600 bg-yellow-300 hover:text-black-600 dark:text-black-500 dark:hover:text-yellow-500 border-yellow-600 dark:border-yellow-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-black-600 dark:text-gray-400 border-black-100 hover:border-black-300 dark:border-black-700 dark:hover:text-gray-300" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Terbaru</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Upcoming</button>
                        </li>
                    </ul>
                </div>
                <div id="default-styled-tab-content">
                    <div class="hidden p-4 rounded-lg bg-gray-100 rounded-xl grid grid-rows-[auto 1fr 1fr 1fr] grid-cols-4 gap-4" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
                        @foreach ($newestBeasiswa as $index => $beasiswa)
                            @if ($index === 0)
                                <div class="row-span-2 col-span-2 bg-yellow-700 flex flex-col rounded-2xl">
                                    <div class="flex-1 flex flex-col max-w-4xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <div href="#" class="flex flex-col md:flex-row flex-1 items-stretch bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <!-- Image section -->
                                            <img class="w-1/2 object-cover rounded-t-lg md:rounded-none md:rounded-s-lg pr-2" 
                                                src="https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/poster%2FPoster-Beasiswa-Prestasi-Kita-4.jpg?alt=media&token=e80d5dad-456e-4fc5-bf19-16cbf4365244" 
                                                alt="">
                                
                                            <!-- Content section -->
                                            <div class="flex flex-col flex-1 justify-between p-4 leading-normal pl-2">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                    Noteworthy technology acquisitions 2021
                                                </h5>
                                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                    Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.
                                                </p>
                                                <div>
                                                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                                                        Lihat Selengkapnya
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                                  
                            @else
                                <div class="row-span-2 bg-yellow-700 flex flex-col rounded-2xl">
                                    <div class="flex-1 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <a href="#">
                                            <img class="h-48 w-full object-cover rounded-t-lg" src="https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/poster%2FPoster-Beasiswa-Prestasi-Kita-4.jpg?alt=media&token=e80d5dad-456e-4fc5-bf19-16cbf4365244" alt="" />
                                        </a>
                                        <div class="p-5">
                                            <a href="#">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $beasiswa->nama_beasiswa }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $beasiswa->short_description }}</p>
                                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                                                Lihat Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                    <div class="hidden p-4 rounded-lg bg-gray-100 rounded-xl" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <p class="text-sm text-gray-500">This is some placeholder content the <strong class="font-medium text-gray-800">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
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
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col items-center p-10">
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg mb-5" src="https://s1.zerochan.net/Mudrock.600.3200855.jpg" alt="Bonnie image"/>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $penerima->nama_depan }} {{ $penerima->nama_belakang }}</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $penerima->nama_prodi }} @ {{ $penerima->angkatan }}</span>
                        <div class="flex mt-2 md:mt-4 flex flex-col gap-1 justify-center items-center text-center">
                            <p class="text-white">Penerima Beasiswa</p>
                            <h1 class="text-white font-bold">{{ $penerima->nama_beasiswa }}</h1>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="p-5">
            {{ $newestMahasiswaAccepted->links() }}
        </div>
    </div>
</div>

@endsection