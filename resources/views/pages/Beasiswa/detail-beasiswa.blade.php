@extends('layouts.main')
@section('content')
    @include('component.navbar')
    <div class="p-2">
        <div class=" flex flex-auto">
            <div class="basis-1/4 flex justify-center  border-4 rounded-xl shadow  p-5">
                <img src="https://th.bing.com/th/id/OIP.Hm3Ll_0FLV3Se-jBtxSmQAHaKe?w=202&h=286&c=7&r=0&o=5&dpr=1.3&pid=1.7"
                    alt="">
            </div>
            <div class="p-8 basis-3/4">
                <h1 class="text-2xl font-semibold">Beasiswa LKPD</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero obcaecati suscipit consequatur sint dolore,
                    natus veniam commodi modi ea nihil beatae asperiores consequuntur possimus non enim, accusantium numquam
                    aperiam fugit.
                    In, explicabo nulla! Suscipit necessitatibus, porro excepturi sapiente expedita natus est magnam
                    commodi, officiis neque impedit quia accusamus! Vero praesentium sequi laudantium deserunt saepe
                    incidunt molestias consectetur impedit nesciunt placeat?
                    Nostrum illum neque aliquam, maiores voluptates quod rerum fugiat necessitatibus quia ipsam fuga
                    delectus ipsum ipsa. Voluptates placeat optio harum officiis asperiores ratione, eum totam,
                    exercitationem voluptas hic neque obcaecati.
                    Quia, impedit.</p>
                <div class=" rounded-3xl p-3 bg-yellow-400 inline-block mt-4">
                    <div class="flex gap-7">
                        <h4 class="font-medium text-black">Apply Now</h4>
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
            @include('component.slider')

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
            <h1 class="text-2xl font-semibold text-yellow-400">Dokumen</h1>
            <div class=" w-10 h-2 rounded-xl bg-orange-500"></div>
            <div class="flex p-10 ">
                <div class="basis-1/2 flex flex-col justify-center items-center">
                    <div class="">
                        <h1 class="text-2xl font-semibold">Beasiswa LKPD</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero obcaecati suscipit consequatur sint
                            dolore,
                            natus veniam commodi modi ea nihil beatae asperiores consequuntur possimus non enim, accusantium
                            numquam
                            aperiam fugit.
                            .</p>
                    </div>
                </div>
                <div class="basis-1/2 flex justify-center">
                    <div id="carouselExampleSlidesOnly" class="relative" data-twe-carousel-init data-twe-ride="carousel">
                        <!--Carousel items-->
                        <div class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
                            <!--First item-->
                            <div class="relative float-left -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                                data-twe-carousel-item data-twe-carousel-active>
                                <img src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp" class="block w-full"
                                    alt="Wild Landscape" />
                            </div>
                            <!--Second item-->
                            <div class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                                data-twe-carousel-item>
                                <img src="https://mdbcdn.b-cdn.net/img/new/slides/042.webp" class="block w-full"
                                    alt="Camera" />
                            </div>
                            <!--Third item-->
                            <div class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                                data-twe-carousel-item>
                                <img src="https://mdbcdn.b-cdn.net/img/new/slides/043.webp" class="block w-full"
                                    alt="Exotic Fruits" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
