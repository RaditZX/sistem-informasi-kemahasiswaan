@extends('layouts.main')
@section('content')
    @include('component.navbar',['path'=>"Detail Beasiswa",'id'=>$id])
    <div class="p-2 pl-10">
        <div class=" flex flex-auto">
            <div class="basis-1/4 flex justify-center  border-4 rounded-xl shadow  p-5">
                <img src="https://th.bing.com/th/id/OIP.Hm3Ll_0FLV3Se-jBtxSmQAHaKe?w=202&h=286&c=7&r=0&o=5&dpr=1.3&pid=1.7"
                    alt="">
            </div>
            <div class="p-8 basis-3/4">

                <h1 class="text-2xl font-semibold">{{ $beasiswa->nama_beasiswa }}</h1>
                <div class="flex mb-3 gap-3">
                    <div class=" rounded-xl p-1 px-3 bg-orange-400 inline-block mt-4">
                        <h5 class="font-medium text-base text-white">{{ $beasiswa->tipe_beasiswa }}</h5>
                    </div>
                    <div class=" rounded-xl p-1 px-3 bg-orange-400 inline-block mt-4">
                        <h5 class="font-medium text-base text-white">{{ $beasiswa->jenis_waktu_beasiswa }}</h5>
                    </div>
                </div>
                <p>{{ $beasiswa->deskripsi }}</p>

                <div class=" rounded-3xl p-3 bg-yellow-400 inline-block mt-4">
                    <div class="flex gap-7">
                        <h4 class="font-medium text-base text-black">Apply Now</h4>
                        <div class="bg-black rounded-xl inline-block p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- Benefit --}}
        <div class="mt-5">
            <h1 class="text-2xl font-semibold text-yellow-400">Benefit</h1>
            <div class=" w-10 h-2 rounded-xl bg-orange-500"></div>
            @include('component.slider', ['beasiswa' => $beasiswa], ['isBenefit' => true])


        </div>

        {{-- Syarat --}}
        <div class="mt-5">
            <h1 class="text-2xl font-semibold text-yellow-400">Syarat</h1>
            <div class=" w-10 h-2 rounded-xl bg-orange-500"></div>
            <div class="grid grid-cols-4 gap-5 py-5">
                <div>
                    <p class="text-m font-medium">Tingkat Pendidikan :</p>
                    <p>Diploma-III</p>
                </div>
                <!-- ... -->
                <div>
                    <p class="text-m font-medium">Tingkat Pendidikan :</p>
                    <p>Diploma-III</p>
                </div>

                <div>
                    <p class="text-m font-medium">Tingkat Pendidikan :</p>
                    <p>Diploma-III</p>
                </div>

                <div>
                    <p class="text-m font-medium">Tingkat Pendidikan :</p>
                    <p>Diploma-III</p>
                </div>

                <div>
                    <p class="text-m font-medium">Tingkat Pendidikan :</p>
                    <p>Diploma-III</p>
                </div>
                <!-- ... -->
                <div>
                    <p class="text-m font-medium">Tingkat Pendidikan :</p>
                    <p>Diploma-III</p>
                </div>

                <div>
                    <p class="text-m font-medium">Tingkat Pendidikan :</p>
                    <p>Diploma-III</p>
                </div>

                <div>
                    <p class="text-m font-medium">Tingkat Pendidikan :</p>
                    <p>Diploma-III</p>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <h1 class="text-2xl font-semibold text-yellow-400">Syarat Dokumen</h1>
            <div class=" w-10 h-2 rounded-xl bg-orange-500"></div>
            <div class="flex p-10 ">
                <div class="basis-1/2 flex flex-col justify-center items-start">
                    <div class="">
                        <h1 class="text-2xl font-semibold slide-text" id="slide-text">Beasiswa LKPD</h1>
                        <p id="slides-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero obcaecati suscipit consequatur sint
                            dolore,
                            natus veniam commodi modi ea nihil beatae asperiores consequuntur possimus non enim, accusantium
                            numquam
                            aperiam fugit.
                            .</p>
                    </div>
                </div>
                <div class="basis-1/2 flex justify-center">
                    @include(
                        'component.document-slider',
                        ['beasiswa' => $beasiswa],
                        ['isBenefit' => false]
                    )
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.swiperInstance) {
                const slideTexts = [
                    @foreach ($beasiswa->syaratDokumen as $syarat)
                        "{{ $syarat->dokumen }}", // Store benefit text in an array
                    @endforeach
                ];

                const slideDescriptionTexts = [
                    @foreach ($beasiswa->syaratDokumen as $syarat)
                        "{{ $syarat->deskripsi_dokumen }}", // Store benefit text in an array
                    @endforeach
                ];


                document.getElementById('slide-text').innerText = slideTexts[window.swiperInstance.realIndex];
                document.getElementById('slides-description').innerText = slideDescriptionTexts[window.swiperInstance.realIndex];

                window.swiperInstance.on('slideChange', function() {
                    const currentIndex = window.swiperInstance.realIndex;
                    document.getElementById('slide-text').innerText = slideTexts[currentIndex];
                    document.getElementById('slides-description').innerText = slideDescriptionTexts[currentIndex];
                });
            } else {
                console.error("Swiper instance not found.");
            }
        });
    </script>
@endsection
